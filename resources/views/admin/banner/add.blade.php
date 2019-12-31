@include('admin.common.header')
	<div class="x-body">
		<form class="layui-form" enctype="multipart/form-data">
			<div class="layui-form-item">
				<label for="banner_img" class="layui-form-label">
					<span class="x-red">*</span>轮播图
				</label>
				<div class="layui-input-inline">
				  <div class="site-demo-upbar">
					<input type="file" name="images" class="layui-upload-file" id="banner_img">
				  </div>
				</div>
			</div>
			<div class="layui-form-item">
				<label  class="layui-form-label">缩略图
				</label>
				<img id="LAY_demo_upload" style="width: 112px; height: 80px;" width="400" src="">
			</div>
			<div class="layui-form-item">
				<label for="link" class="layui-form-label">
					链接地址
				</label>
				<div class="layui-input-inline">
					<input type="text" id="link" value="{{url('/')}}" name="link_url" class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label for="sort" class="layui-form-label">
					展示排序
				</label>
				<div class="layui-input-inline">
					<input type="text" id="sort" value="0" name="sort" class="layui-input">
				</div>
				<div class="layui-form-mid layui-word-aux">
					<span class="x-red">越大排在前面最大不能超过255</span>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">是否显示</label>
				<div class="layui-input-block">
					 <input type="radio" name="is_show" checked value="0" title="显示">
					 <input type="radio" name="is_show" value="-1" title="隐藏">
				</div>
			 </div>
			<div class="layui-form-item">
				<label class="layui-form-label" for="art_id">选择文章</label>
				<div class="layui-input-block">
					<select name="art_id" id="art_id" lay-verify="required">
						<option value="0">请选择文章</option>
						<?php foreach ($article as $art): ?>
							<option value="{$art['art_id']}">{{$art['art_title']}}</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="layui-form-item layui-form-text">
				<label for="img_des" class="layui-form-label">
					图片描述
				</label>
				<div class="layui-input-block">
			     	<textarea for="img_des" name="img_des" placeholder="请输入内容" class="layui-textarea"></textarea>
			    </div>
			</div>
			{{csrf_field()}}
			<input type="hidden" name="img_url" value="">
			<div class="layui-form-item">
				<label for="L_repass" class="layui-form-label">
				</label>
				<button  class="layui-btn" lay-filter="add" lay-submit="">
					确定
				</button>
			</div>
		</form>
	</div>
	<script>
		layui.use(['form','layer','upload'], function(){
			$ = layui.jquery;
		  	var form = layui.form()
		  	,layer = layui.layer;


		//图片上传接口
		layui.upload({
			url: '{{url("admin/index/uploads")}}' //上传接口
			,data:{'_token':'{{csrf_token()}}'}
			,success: function(res){ //上传成功后的回调
				// console.log(res);
				if (res['status'] == 1)
				{
					// 显示图片并记录图片地址
					$('input[name="img_url"]').val(res['img_url']);
			  		$('#LAY_demo_upload').attr('src', res['all_imgurl']);
				} else {
					layer.msg('图片上传失败', {icon: 5});
				}
			}
		});
		

		  //监听提交
		form.on('submit(add)', function(data){
			// console.log(data['field']);
			// var images = $("#banner_img")[0].files[0];
			var img_url = $("input[name='img_url']").val();
			if (!img_url) {
				layer.msg('请上传图片', {icon: 5});
				return false;
			}

			// 提交数据到后台
			var _this = parent.layer;
			$.ajax({
				url: "{{url('admin/banner/store')}}",
				type: 'post',
				data: data['field'],
				success:function(res){
					if (res['status'] == 1)
					{
						// var index = _this.getFrameIndex(window.name);
						// _this.close(index);
						layer.msg(res['msg'], {icon: 6});
						setTimeout(function(){window.parent.location.reload();}, 2000);
					} else {
						layer.msg(res['msg'], {icon: 5});
					}
				}
			});
			return false;
		  });
		  
		  
		});
	</script>
</body>

</html>
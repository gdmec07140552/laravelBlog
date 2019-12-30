<!-- 判断js文件是否需要引入 -->
<?php if (in_array('layui', $js_array)): ?>
	<script src="{{asset('static/admin/lib/layui/layui.js')}}" charset="utf-8"></script>
<?php endif; ?>

<?php if (in_array('x-admin', $js_array)): ?>
	<script src="{{asset('static/admin/js/x-admin.js')}}"></script>
<?php endif; ?>

<?php if (in_array('x-layui', $js_array)): ?>
	<script src="{{asset('static/admin/js/x-layui.js')}}" charset="utf-8"></script>
<?php endif; ?>
<script src="{{asset('static/admin/js/jquery.min.js')}}"></script>

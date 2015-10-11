
<?php if ($message) : ?>
    <div class="alert alert-danger" role="alert"><?= $message; ?></div>
<? endif; ?>



<div class="panel panel-default" id="login-form">
    <div class="panel-heading"><?= __('login'); ?></div>
    <div class="panel-body">
        <?= Form::open('admin/auth/login', array('role' => 'form')); ?>
        <div class="form-group">
            <?= Form::label('username', __('username')); ?>
            <?= Form::input('username', HTML::chars(Arr::get($_POST, 'username')), array('class' => 'form-control', 'id' => 'username')); ?>
        </div>

        <div class="form-group">
            <?= Form::label('password', __('password')); ?>
            <?= Form::password('password', HTML::chars(Arr::get($_POST, 'v')), array('class' => 'form-control', 'id' => 'password')); ?>
        </div>

        <?= Form::submit('login', __('login'), array('class' => 'btn btn-default')); ?>
        <?= Html::anchor('admin/auth/forgotten', __('forgotten'), array('class' => 'pull-right')); ?>
        <?= Form::close(); ?>
    </div>
</div>
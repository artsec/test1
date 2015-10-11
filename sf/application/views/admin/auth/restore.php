<div class="panel panel-default" id="login-form">
    <div class="panel-heading"><?= __('forgotten'); ?></div>
    <div class="panel-body">
        <?php if ($message) : ?>
            <div class="alert alert-<?= $message['type']; ?>" role="alert"><?= $message['text']; ?></div>
        <? endif; ?>

        <? if (!isset($message['type']) or $message['type'] != 'success') : ?>
            <?= Form::open(); ?>

            <div class="form-group">
                <?= Form::label('password', __('password')); ?>
                <?= Form::password('password', HTML::chars(Arr::get($_POST, 'v')), array('class' => 'form-control', 'id' => 'password')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('password_confirm', __('repassword')); ?>
                <?= Form::password('password_confirm', HTML::chars(Arr::get($_POST, 'v')), array('class' => 'form-control', 'id' => 'password_confirm')); ?>
            </div>

            <?= Form::submit('restore', __('restore'), array('class' => 'btn btn-default')); ?>
            <?= Form::close(); ?>
        <? endif; ?>
    </div>
</div>
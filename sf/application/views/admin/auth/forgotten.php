<div class="panel panel-default" id="login-form">
    <div class="panel-heading"><?= __('forgotten'); ?></div>
    <div class="panel-body">
        <?php if ($message) : ?>
            <div class="alert alert-<?= $message['type']; ?>" role="alert"><?= $message['text']; ?></div>
        <? endif; ?>

        <?= Form::open(); ?>
        <div class="form-group">
            <?= Form::label('email_login', __('email_login')); ?>
            <?= Form::input('email_login', HTML::chars(Arr::get($_POST, 'email_login')), array('class' => 'form-control', 'id' => 'email_login')); ?>
        </div>

        <?= Form::submit('restore', __('restore'), array('class' => 'btn btn-default')); ?>
        <?= Form::close(); ?>
    </div>
</div>
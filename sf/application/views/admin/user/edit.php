<?= Form::open(); ?>
    <div class="panel panel-default" id="login-form">
        <div class="panel-heading"><?= $heading_title; ?></div>

        <? if ($error) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error; ?>
            </div>
        <? endif; ?>

        <div class="panel-body">
            <div class="form-group">
                <?= Form::label('name', __('contact.name')); ?>
                <?= Form::input('name', $user->name, array('class' => 'form-control', 'id' => 'name')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('surname', __('contact.surname')); ?>
                <?= Form::input('surname', $user->surname, array('class' => 'form-control', 'id' => 'surname')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('email', __('contact.email')); ?>
                <?= Form::input('email', $user->email, array('class' => 'form-control', 'id' => 'email')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('username', __('contact.username')); ?>
                <?= Form::input('username', $user->username, array('class' => 'form-control', 'id' => 'username')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('password', __('contact.password')); ?>
                <?= Form::input('password', $password, array('class' => 'form-control', 'id' => 'password')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('roles', __('contact.role')); ?>
                <?= Form::select('roles[]', $roles, $user_roles, array('class' => 'form-control', 'id' => 'roles', 'multiple' => 'multiple')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('object_id', __('contact.object')); ?>
                <?= Form::select('object_id', $objects, $user->object_id, array('class' => 'form-control', 'id' => 'object_id')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('language', __('contact.language')); ?>
                <?= Form::select('language', $languages, $user->language, array('class' => 'form-control', 'id' => 'language')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('listsize', __('contact.listsize')); ?>
                <?= Form::select('listsize', $listsizes, $user->listsize, array('class' => 'form-control', 'id' => 'listsize')); ?>
            </div>

            <div class="form-group">
                <?= Form::label('status', __('contact.status')); ?>
                <?= Form::select('status', $statuses, $user->status, array('class' => 'form-control', 'id' => 'status')); ?>
            </div>

            <?= Form::submit('save', __('save'), array('class' => 'btn btn-default')); ?>
        </div>
    </div>
<?= Form::close(); ?>
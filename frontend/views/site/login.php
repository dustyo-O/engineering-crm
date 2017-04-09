<?php
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */

$login_field_template = <<<HTML

HTML;
?>
<?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'smart-form client-form']]); ?>

    <header>
        Sign In
    </header>

    <fieldset>

        <?=
        $form->field($model, 'username',
            ['template' => $this->render('/construct/login-input', [ 'icon' => 'fa-user' ])])
            ->textInput(['placeholder' => 'admin'])
        ?>

        <?=
        $form->field($model, 'password',
            ['template' => $this->render('/construct/login-input', [ 'icon' => 'fa-lock' ])])
            ->textInput()
        ?>

        <?=
        $form->field($model, 'rememberMe',
            ['template' => <<<HTML
        <section>
            <label class="checkbox">
                {input}
                <i></i>{label}</label>
        </section>
HTML
])
            ->checkbox()
        ?>
    </fieldset>
    <footer>
        <button type="submit" class="btn btn-primary">
            Sign in
        </button>
    </footer>
<?php
    ActiveForm::end();
?>
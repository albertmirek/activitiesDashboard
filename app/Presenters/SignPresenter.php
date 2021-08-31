<?php


namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


class SignPresenter extends Nette\Application\UI\Presenter
{

        public function actionInteract():void{
        if(!$this->getUser()->isLoggedIn()){
            $this->redirect('Sign:out');
        }
    }

    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->addText('username', 'Username:')
            ->setRequired('Please enter your username.');

        $form->addPassword('password', 'Password:')
            ->setRequired('Please enter your password.');

        $form->addSubmit('send', 'Sign in');

        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }

    public function signInFormSucceeded(Form $form, \stdClass $values): void
    {
        try {
            $this->getUser()->login($values->username, $values->password);
            $this->redirect('Homepage:');

        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Nesprávné přihlašovací jméno nebo heslo.');
        }
    }
}
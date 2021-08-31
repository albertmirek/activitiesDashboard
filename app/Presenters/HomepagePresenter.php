<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    private $database;



    public function __construct(Nette\Database\Explorer $database)
    {
        $this->database = $database;
    }

    public function renderDefault(): void {
        $this->template->users = $this->database->table('users')->limit(1)->fetch();

        //dump($this->users);
    }

}

<?php

namespace src\Controller\AccountList;

use src\Provider\AccountListProvider\AccountListProvider;
use src\Structure\AbstractController\AbstractController;

class AccountList extends AbstractController
{
    public function AccountListingAction()
    {
        $this->setPageTitle("User Account List");

        $accountListProvider = new AccountListProvider();
        $accounts = $accountListProvider->getAllUserAccounts();

        $this->render("AccountList/AccountList.php", ['accounts' => $accounts]);
    }
}
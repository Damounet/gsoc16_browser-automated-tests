<?php
/**
 * @package     Joomla.Tests
 * @subpackage  Acceptance.tests
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
use Page\Acceptance\Administrator;

/**
 * Administrator User Tests
 *
 * @since  __DEPLOY_VERSION__
 */
class UserCest
{

	/**
	 * Create an user
	 *
	 * @param   AcceptanceTester  $I  The AcceptanceTester Object
	 *
	 * @since   __DEPLOY_VERSION__
	 *
	 * @return  void
	 */
	public function createUser(\AcceptanceTester $I)
	{
		$I->comment('I am going to create an user');
		$I->doAdministratorLogin();

		$I->amOnPage(Administrator\UserManagerPage::$url);
		$I->checkForPhpNoticesOrWarnings();
		$I->click(Administrator\UserManagerPage::$newButton);

		$I->waitForElement(Administrator\UserManagerPage::$accountDetailsTab);
		$I->checkForPhpNoticesOrWarnings();

		$this->fillUserForm($I, $this->name, $this->username, $this->password, $this->email);

		$I->click(Administrator\UserManagerPage::$saveButton);
		$I->waitForText(Administrator\UserManagerPage::$pageTitleText);
		$I->see(Administrator\UserManagerPage::$successMessage, Administrator\AdminPage::$systemMessageContainer);

		$I->checkForPhpNoticesOrWarnings();
	}


	/**
	 * Method is a page object to fill user form with given information and prepare to save user.
	 *
	 * @param   AcceptanceTester  $I         The AcceptanceTester Object
	 * @param   string            $name      User's name
	 * @param   string            $username  User's username
	 * @param   string            $password  User's password
	 * @param   string            $email     User's email
	 *
	 * @since   __DEPLOY_VERSION__
	 *
	 * @return  void  The user's form will be filled with given detail
	 */
	protected function fillUserForm($I, $name, $username, $password, $email)
	{
		$I->click(Administrator\UserManagerPage::$accountDetailsTab);
		$I->waitForElementVisible(Administrator\UserManagerPage::$nameField, 30);
		$I->fillField(Administrator\UserManagerPage::$nameField, $name);
		$I->fillField(Administrator\UserManagerPage::$usernameField, $username);
		$I->fillField(Administrator\UserManagerPage::$passwordField, $password);
		$I->fillField(Administrator\UserManagerPage::$password2Field, $password);
		$I->fillField(Administrator\UserManagerPage::$emailField, $email);
	}
}

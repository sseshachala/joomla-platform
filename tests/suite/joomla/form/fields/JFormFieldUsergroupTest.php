<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JForm.
 *
 * @package		Joomla.UnitTest
 * @subpackage  Form
 */
class JFormFieldUsergroupTest extends JoomlaTestCase
{
	/**
	 * Sets up dependancies for the test.
	 */
	protected function setUp()
	{
		require_once JPATH_PLATFORM.'/joomla/form/fields/usergroup.php';
		include_once dirname(__DIR__).'/inspectors.php';
	}

	/**
	 * Test the getInput method.
	 */
	public function testGetInput()
	{
		$form = new JFormInspector('form1');

		$this->assertThat(
			$form->load('<form><field name="usergroup" type="usergroup" /></form>'),
			$this->isTrue(),
			'Line:'.__LINE__.' XML string should load successfully.'
		);

		$field = new JFormFieldUsergroup($form);

		$this->assertThat(
			$field->setup($form->getXml()->field, 'value'),
			$this->isTrue(),
			'Line:'.__LINE__.' The setup method should return true.'
		);

		$this->markTestIncomplete('Problems encountered in next assertion');

		$this->assertThat(
			strlen($field->input),
			$this->greaterThan(0),
			'Line:'.__LINE__.' The getInput method should return something without error.'
		);

		// TODO: Should check all the attributes have come in properly.
	}
}

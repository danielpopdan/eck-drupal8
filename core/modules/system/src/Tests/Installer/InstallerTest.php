<?php

/**
 * @file
 * Contains \Drupal\system\Tests\Installer\InstallerTest.
 */

namespace Drupal\system\Tests\Installer;

use Drupal\simpletest\InstallerTestBase;

/**
 * Tests the interactive installer.
 *
 * @group Installer
 */
class InstallerTest extends InstallerTestBase {

  /**
   * Ensures that the user page is available after installation.
   */
  public function testInstaller() {
    $this->assertUrl('user/1');
    $this->assertResponse(200);
    // Confirm that we are logged-in after installation.
    $this->assertText($this->root_user->getUsername());

    // Verify that the confirmation message appears.
    require_once \Drupal::root() . '/core/includes/install.inc';
    $this->assertRaw(t('Congratulations, you installed @drupal!', array(
      '@drupal' => drupal_install_profile_distribution_name(),
    )));
  }

  /**
   * Installer step: Select language.
   */
  protected function setUpLanguage() {
    // Test that \Drupal\Core\Render\BareHtmlPageRenderer adds assets and
    // metatags as expected to the first page of the installer.
    $this->assertRaw('core/themes/seven/css/components/buttons.css');
    $this->assertRaw('<meta name="charset" charset="utf-8" />');
    parent::setUpLanguage();
  }
}

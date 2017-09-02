<?php

namespace Drupal\webform\Tests\Element;

use Drupal\webform\Tests\WebformTestBase;

/**
 * Tests for element help.
 *
 * @group Webform
 */
class WebformElementHelpTest extends WebformTestBase {

  /**
   * Webforms to load.
   *
   * @var array
   */
  protected static $testWebforms = ['test_element_help'];

  /**
   * Test element help.
   */
  public function testHelp() {
    $this->drupalGet('webform/test_element_help');

    // Check basic help.
    $this->assertRaw('<a href="#help" title="{This is an example of help}" data-webform-help="{This is an example of help}" class="webform-element-help">?</a>');

    // Check help with HTML markup.
    $this->assertRaw('<a href="#help" title="{This is an example of help with HTML markup}" data-webform-help="{This is an example of help with &lt;b&gt;HTML markup&lt;/b&gt;}" class="webform-element-help">?</a>');

    // Check help with XSS.
    $this->assertRaw('<a href="#help" title="{This is an example of help with XSS alert(&quot;XSS&quot;)}" data-webform-help="{This is an example of help with &lt;b&gt;XSS alert(&quot;XSS&quot;)&lt;/b&gt;}" class="webform-element-help">?</a>');

    // Check help with inline title.
    $this->assertRaw('<a href="#help" title="{This is an example of help with an inline title}" data-webform-help="{This is an example of help with an inline title}" class="webform-element-help">?</a>
help_inline</label>');
  }

}

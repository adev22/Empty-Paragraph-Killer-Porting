<?php

/**
 * @file
 * Contains Drupal\emptyparagraphkiller\Plugin\Filter\Emptyparagraphkiller
 */

namespace Drupal\emptyparagraphkiller\Plugin\Filter;

use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * @Filter(
 *   id = "empty_paragraph_killer",
 *   title = @Translation("Empty paragraph filter"),
 *   description = @Translation("When entering more than one carriage return, only the first will be honored."),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
 * )
 */

class Emptyparagraphkiller extends FilterBase {

  public function prepare($text, $langcode) {

    return preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '[empty-para]', $text);

  }

  public function process($text, $langcode) {

    $result = str_replace('[empty-para]', '', $text);
    return new FilterProcessResult($result);

  }

  public function tips($long = False) {

   if ($long) {
    return t('Your typing habits may include hitting the return key twice when completing a paragraph. This site will accomodate your habit, and ensure the content is in keeping with the the stylistic formatting of the site\'s theme.');
  }
  else {
    return t('Empty paragraph killer - multiple returns will not break the site\'s style.');
  }
  
  }



}
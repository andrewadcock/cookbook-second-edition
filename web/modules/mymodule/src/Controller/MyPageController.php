<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses from My Module module
 *
 * @package Drupal\mymodule\Controller
 */
class MyPageController extends ControllerBase
{

    /**
     * Returns markup for our custom page
     */
    public function customPage() {
        return [
            '#markup' => t('Welcome to my custom page'),
        ];
    }
}
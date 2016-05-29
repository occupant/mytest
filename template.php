<?php

/** hook_theme() 
---------------------------------------------------------- */
function finance_theme() {
  return array(
    'visual_identity_footer' => array(
      'variables' => array('element' => NULL)    
    ),
    
    /*
    'megatron_links' => array(
      'variables' => array(
        'links' => array(), 
        'attributes' => array(), 
        'heading' => NULL
      ),
    ),
    */
  );
}

/** HTML.TPL.PHP PREPROCESS VARIABLES
---------------------------------------------------------- */
function finance_preprocess_html(&$vars) {
  
  drupal_add_css('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array('type' => 'external', 'group'=>CSS_THEME, 'every_page' => TRUE, 'weight' => -89));
  // UBC WEB SERVICES DEV VERSION - REMOVE FROM PRODUCTION
 drupal_add_css('https://cloud.typography.com/7574694/6365152/css/fonts.css', array('type' => 'external', 'group'=>CSS_THEME, 'every_page' => TRUE, 'weight' => -90));
  // UBC COMMUNICATIONS PRODUCTION VERSION
  //drupal_add_css('https://cloud.typography.com/6804272/781004/css/fonts.css', array('type' => 'external', 'group'=>CSS_THEME, 'every_page' => TRUE, 'weight' => -90));
  drupal_add_css(drupal_get_path('theme', 'finance') . '/css/minimal-clf-7.0.4-bw.css', array('group'=>CSS_THEME, 'every_page' => TRUE, 'weight' => -1));
  drupal_add_css(drupal_get_path('theme', 'finance') . '/css/unit.css', array('group'=>CSS_THEME, 'every_page' => TRUE, 'weight' => 0));
  
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/requestanimationframe/jquery.requestAnimationFrame.min.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -100));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/bootstrap/affix.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -99));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/core.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -98));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/touch.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -97));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/mediaquery.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -96));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/swap.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -95));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/scrollbar.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -94));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/equalize.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -93));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/dropdown.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -92));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/navigation.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -91));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/formstone/carousel.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -90));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/libs/wow/wow.min.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => -89));
  drupal_add_js(drupal_get_path('theme', 'finance') . '/js/custom.js', array('scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => 0));
  // add inline scripts at bottom of JS_THEME scope
  
  drupal_add_js('new WOW().init();',
    array('type' => 'inline', 'scope' => 'footer', 'group' => JS_THEME, 'every_page' => TRUE, 'weight' => 10)
  );
}


/** BOOTSTRAP THEME FUNCTIONS USED */
/** Alter the span class for a region (main content / sidebars)
---------------------------------------------------------- */
function _finance_content_span($columns = 1) {
  $class = FALSE;
  switch($columns) {
  case 1:
    // default (no sidebars)
    $class = 'col-md-12';
    break;
  case 2:
    // 1 sidebar
    $class = 'col-md-9';
    break;
  case 3:
    // 2 sidebars
    $class = 'col-md-6';
    break;
  case 4:
    // front with 1 sidebar
    $class = 'col-md-12';
    break;
  }
  return $class;
}

function finance_css_alter(&$css) {
  // Remove css files.
  unset($css[path_to_theme('megatron') . '/css/secondary-nav.css']);
  unset($css[path_to_theme('finance') . '/css/secondary-nav.css']);
}

/** THEME MENU UNORDERED LIST MARKUP
theme all sets of links
-- you can override this for specific menus with megatron_menu_tree__menu_name
---------------------------------------------------------- */
function finance_menu_tree(&$variables) {
  return '<ul class="menu nav sidenav">' . $variables['tree'] . '</ul>';
}

/** BREADCRUMB ALTERATIONS
Return a themed breadcrumb trail
---------------------------------------------------------- */
function finance_breadcrumb($variables) {
  global $base_path;
  $breadcrumb = $variables['breadcrumb'];
  $breadcrumb = array_unique($breadcrumb);
  $breadcrumb[0] = '<a href="' . $base_path . '" title="' . theme_get_setting('clf_unitname') . '">Home</a>'; 
  $show_breadcrumb = theme_get_setting('breadcrumb_display');
  $pos = FALSE;
    
  if ((!empty($breadcrumb)) && ($show_breadcrumb == 'yes')) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '';
    $crumbs = '<nav class="row"><h2 class="element-invisible">' . t('You are here') . '</h2><ul class="breadcrumb vert-content-space-3-1">';
    $crumbs .= '';
    
    $array_size = count($breadcrumb);
    $i = 0;
    while ( $i < $array_size) {
      if(drupal_get_title()) {
        $pos = strpos($breadcrumb[$i], drupal_get_title());
      }
      //we stop duplicates entering where there is a sub nav based on page jumps
      if ($pos === false){
        $crumbs .= '<li class="breadcrumb-' . $i;
        $crumbs .=  '">' . $breadcrumb[$i] . ' ';
      }
      $i++;
    }
    $crumbs .= '<li class="active">'. drupal_get_title() .'</li></ul></nav>';
    return $crumbs;
  }
  return '';
}

/** FORMS
Implements hook_form_alter().
---------------------------------------------------------- */
function finance_form_alter(&$form, &$form_state, $form_id) {
  // Customize the search block form
  if ($form_id) {
    switch ($form_id) {
      case 'search_form':
        // Add a clearfix class so the results don't overflow onto the form.
        $form['#attributes']['class'][] = 'vert-content-space-2-3';
        // remove the div around the input
        $form['basic']['#theme_wrappers'] = NULL; 
        // remove the div around the submit
        $form['basic']['keys']['#theme_wrappers'] = NULL; 
        $form['basic']['#prefix'] = '<div class="form-inline"><div class="form-group">';
        $form['basic']['#suffix'] = '</div>
          <button class="btn btn-primary" type="submit">
           Search <i class="fa fa-search"></i> 
          </button>
        </div>';
        // Hide the default button from display.
        $form['basic']['submit']['#attributes']['class'][] = 'element-invisible';
        // Implement a theme wrapper to add a submit button containing a search
        // icon directly after the input element.
        $form['basic']['keys']['#title'] = t('');
        //control the width of the input           
        //$form['basic']['keys']['#attributes']['class'][] = 'wide input';
        $form['basic']['keys']['#attributes']['placeholder'] = t('Search');
      break;
      case 'search_block_form':
        $form['#attributes']['class'][] = 'form-inline vert-content-space-1-0';
        // Change the text on the label element
        $form['search_block_form']['#title'] = t(''); 
        $form['search_block_form']['#size'] = 30;
        $form['search_block_form']['#attributes']['title'] = t('enter your search terms...');
        $form['search_block_form']['#attributes']['placeholder'] = t('Search UBC Finance');
        $form['search_block_form']['#attributes']['class'][] = 'search-query';
        $form['search_block_form']['#prefix'] = '<div class="form-group input-group">';
        // remove the div around the input
        $form['search_block_form']['#theme_wrappers'] = NULL; 
        // add a submit button containing a search icon directly before the
        // input element.
        $form['actions']['#prefix'] = '<div class="input-group-btn">
          <button class="btn btn-default btn-sm" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>';
        $form['actions']['#suffix'] = '</div>';
        // Hide the default button from display.
        $form['actions']['submit']['#attributes']['class'][] = 'element-invisible';
        // remove the div around the button
        $form['actions']['#theme_wrappers'] = NULL; 
        // Change the text on the submit button
        $form['actions']['submit']['#value'] = t('Search'); 
        $form['actions']['submit']['#attributes']['class'][] = 'btn btn-default btn-sm';
      break;
      /*
      case 'views-exposed-form':
        $form['#attributes']['class'][] = 'form-inline vert-content-space-1-0';
        $form['combine']['#attributes']['placeholder'] = t('I have a question about...');
        $form['submit']['#attributes'] = array('class' => array('btn-unit'));
      break;
      */
      case 'views-exposed-form-faqs-page':
        $form['#attributes']['class'][] = 'form-inline vert-content-space-1-0';
        $form['combine']['#attributes']['placeholder'] = t('I have a question about...');
        $form['submit']['#attributes'] = array('class' => array('btn-unit'));
      break;
    }
  }
} 

/** Undoes the Megatron changes to the search form input attribute
---------------------------------------------------------- */
function finance_preprocess_search_block_form(&$vars) {
  $vars['search_form'] = str_replace('type="search"', 'type="text"', $vars['search_form']);
}


/** Return the UBC CLF visual identity footer
---------------------------------------------------------- */
function finance_visual_identity_footer($variables) {
    $clf_layout = theme_get_setting('clf_layout');
    $containerstart = '';
    $containerend = '';
    if (($clf_layout == '__full') || ($clf_layout == '__fluid')) {
        $containerstart = '<div class="container">';
        $containerend = '</div>';
    } 
    $output = '<div id="ubc7-unit-footer" class="row-fluid expand">';
    $output .= $containerstart;
    if (theme_get_setting('custom_signature')) {
      $output .= '<div class="row-fluid"><div class="span12"><a class="faculty-identifier ir" href="/">' . theme_get_setting('clf_faculty_name') . '</a></div></div>';
    }
    $output .= '<div class="row-fluid">
      <div class="span5" id="ubc7-unit-address">
        <div class="ubc7-address-unit-name"><strong>Financial Operations</strong></div>
        <div id="ubc7-address-campus">Vancouver campus</div>
        <div class="ubc7-address-street">TEF3-5th Floor, 6190 Agronomy Road</div>
        <div class="ubc7-address-location"><span class="ubc7-address-city">Vancouver</span>, <span class="ubc7-address-province" title="British Columbia">BC</span> <span class="ubc7-address-country">Canada</span> <span class="ubc7-address-postal">V6T 1Z3</span></div><div class="ubc7-address-phone">Tel 604 822 2187</div>
        <div class="ubc7-address-email">E-mail <a href="mailto:website@finance.ubc.ca">website@finance.ubc.ca</a></div>
      </div>';
    
    $output .= '<div class="span7">
      <div class="row-fluid">
        <div class="span6">
          <div class="ubc7-address-unit-name bold">Financial Operations</div>
          <div class="ubc7-address-campus">Okanagan Campus</div>
          <div class="ubc7-address-street">ADM006 - 1138 Alumni Ave</div>
          <div class="ubc7-address-location">
            <span class="ubc7-address-city">Kelowna</span>,
            <span class="ubc7-address-province" title="British Columbia">BC</span>
            <span class="ubc7-address-country">Canada</span>
            <span class="ubc7-address-postal">V1V 1V7</span>
          </div>
          <div class="ubc7-address-phone">Tel 250 807 9018</div>
          <div class="ubc7-address-fax">Fax 250 807 9354</div>
          <div>Email <a href="mailto:pps.ubco@ubc.ca">pps.ubco@ubc.ca</a></div>
          <div>Website <a href="http://pps.ok.ubc.ca" target="_blank">pps.ok.ubc.ca</a></div>
        </div>
        <div class="span6">
          <div class="ubc7-address-unit-name bold">Finance Leadership Office</div>
          <div class="ubc7-address-campus">Koerner Library 6th Floor</div>
          <div class="ubc7-address-street">1958 Main Mall</div>
          <div class="ubc7-address-location">
            <span class="ubc7-address-city">Vancouver</span>,
            <span class="ubc7-address-province" title="British Columbia">BC</span>
            <span class="ubc7-address-country">Canada</span>
            <span class="ubc7-address-postal">V6T 1Z2</span>
          </div>
          <div class="ubc7-address-phone">Tel 604 822 6317</div>
          <div>Email
            <a href="mailto:caroline.cerna@ubc.ca">caroline.cerna@ubc.ca</a>
          </div>
          <div>Website <a href="http://vpfinance.ubc.ca" target="_blank">vpfinance.ubc.ca</a></div>
        </div>
      </div>
    </div>';
    $output .= $containerend;
    $output .= '</div><div class="row-fluid expand ubc7-back-to-top">';
    $output .= $containerstart;
    $output .= '<div class="span2">
          <a href="#wrapper" title="Back to top" class="anchor">Back to top <div class="ubc7-arrow up-arrow grey"></div></a>
        </div>';
    $output .= $containerend;    
    $output .= '</div>';
    return $output;
  }
  
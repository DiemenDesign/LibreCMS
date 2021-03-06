<?php
/**
 * LibreCMS - Copyright (C) Diemen Design 2019
 *
 * Administration - Bookings Settings
 *
 * set_bookings.php version 2.0.2
 *
 * LICENSE: This source file may be modifired and distributed under the terms of
 * the MIT license that is available through the world-wide-web at the following
 * URI: http://opensource.org/licenses/MIT.  If you did not receive a copy of
 * the MIT License and are unable to obtain it through the web, please
 * check the root folder of the project for a copy.
 *
 * @category   Administration - Settings - Bookings
 * @package    core/layout/set_bookings.php
 * @author     Dennis Suitters <dennis@diemen.design>
 * @copyright  2014-2019 Diemen Design
 * @license    http://opensource.org/licenses/MIT  MIT License
 * @version    2.0.2
 * @link       https://github.com/DiemenDesign/LibreCMS
 * @notes      This PHP Script is designed to be executed using PHP 7+
 * @changes    v2.0.1 Change Back Link to Referer
 * @changes    v2.0.2 Add i18n.
 * @changes    v2.0.2 Fix ARIA Attributes.
 */?>
<main id="content" class="main position-relative">
  <ol class="breadcrumb shadow">
    <li class="breadcrumb-item"><a href="<?php echo URL.$settings['system']['admin'].'/bookings';?>"><?php echo localize('Bookings');?></a></li>
    <li class="breadcrumb-item active"><?php echo localize('Settings');?></li>
    <li class="breadcrumb-menu">
      <div class="btn-group" role="group">
        <a class="btn btn-ghost-normal add" href="<?php echo$_SERVER['HTTP_REFERER'];?>" data-tooltip="tooltip" data-placement="left" title="<?php echo localize('Back');?>" role="button" aria-label="<?php echo localize('aria_back');?>"><?php svg('libre-gui-back');?></a>
        <?php if($help['bookings_settings_text']!='')echo'<a target="_blank" class="btn btn-ghost-normal info" href="'.$help['bookings_settings_text'].'" data-tooltip="tooltip" data-placement="left" title="'.localize('Help').'" savefrom_lm="false" role="button" aria-label="'.localize('aria_view_texthelp').'">'.svg2('libre-gui-help').'</a>';
        if($help['bookings_settings_video']!='')echo'<a href="#" class="btn btn-ghost-normal info" data-toggle="modal" data-frame="iframe" data-target="#videoModal" data-video="'.$help['bookings_settings_video'].'" data-tooltip="tooltip" data-placement="left" title="'.localize('Watch Video Help').'" savefrom_lm="false" role="button" aria-label="'.localize('aria_view_videohelp').'">'.svg2('libre-gui-video').'</a>';?>
      </div>
    </li>
  </ol>
  <div class="container-fluid">
    <noscript><div class="alert alert-danger" role="alert"><?php echo localize('alert_all_danger_noscript');?></div></noscript>
    <div class="alert alert-warning d-sm-block d-md-none" role="alert"><?php echo localize('alert_all_warning_smallscreen');?></div>
    <div class="card">
      <div class="card-body">
        <legend><?php echo localize('Email Layout');?></legend>
        <div class="form-group row">
          <label for="bookingEmailReadNotification" class="col-form-label col-sm-2"><?php echo localize('Read Reciept');?></label>
          <div class="input-group col-sm-10">
            <label class="switch switch-label switch-success"><input type="checkbox" id="bookingEmailReadNotification" class="switch-input" data-dbid="1" data-dbt="config" data-dbc="bookingEmailReadNotification" data-dbb="0" role="checkbox"<?php echo$config['bookingEmailReadNotification']{0}==1?' checked aria-checked="true"':' aria-checked="false"';?>><span class="switch-slider" data-checked="<?php echo localize('on');?>" data-unchecked="<?php echo localize('off');?>"></span></label>
          </div>
        </div>
        <div class="help-block text-right"><small><?php echo localize('Tokens');?>:</small> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingEmailSubject','{<?php echo localize('business');?>}');return false;">{<?php echo localize('business');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingEmailSubject','{<?php echo localize('name');?>}');return false;">{<?php echo localize('name');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingEmailSubject','{<?php echo localize('first');?>}');return false;">{<?php echo localize('first');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingEmailSubject','{<?php echo localize('last');?>}');return false;">{<?php echo localize('last');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingEmailSubject','{<?php echo localize('date');?>}');return false;">{<?php echo localize('date');?>}</a>
        </div>
        <div class="form-group row">
          <label for="bookingEmailSubject" class="col-form-label col-sm-2"><?php echo localize('Subject');?></label>
          <div class="input-group col-sm-10">
            <?php echo$user['rank']>899?'<div class="input-group-prepend"><button class="btn btn-secondary fingerprint" data-dbgid="bookingEmailSubject" data-tooltip="tooltip" title="'.localize('Fingerprint Analysis').'" role="button" aria-label="'.localize('aria_fingerprintanalysis').'">'.svg2('libre-gui-fingerprint').'</button></div>':'';?>
            <input type="text" id="bookingEmailSubject" class="form-control textinput" value="<?php echo$config['bookingEmailSubject'];?>" data-dbid="1" data-dbt="config" data-dbc="bookingEmailSubject" role="textbox">
            <div class="input-group-append" data-tooltip="tooltip" data-placement="top" title="<?php echo localize('Save');?>"><button id="savebookingEmailSubject" class="btn btn-secondary save" data-dbid="bookingEmailSubject" data-style="zoom-in" role="button" aria-label="<?php echo localize('aria_save');?>"><?php svg('libre-gui-save');?></button></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="bookingEmailLayout" class="col-form-label col-sm-2"><?php echo localize('Layout');?></label>
          <div class="input-group card-header col-sm-10 p-0">
            <?php echo$user['rank']>899?'<button class="btn btn-secondary btn-sm fingerprint" data-dbgid="bel" data-tooltip="tooltip" title="'.localize('Fingerprint Analysis').'" role="button" aria-label="'.localize('aria_fingerprintanalysis').'">'.svg2('libre-gui-fingerprint').'</button><div id="bel" data-dbid="1" data-dbt="config" data-dbc="bookingEmailLayout"></div>':'';?>
            <div class="col text-right"><small><?php echo localize('Tokens');?>:</small> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('business');?>}');return false;">{<?php echo localize('business');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('name');?>}');return false;">{<?php echo localize('name');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('first');?>}');return false;">{<?php echo localize('first');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('last');?>}');return false;">{<?php echo localize('last');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('date');?>}');return false;">{<?php echo localize('date');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('booking_date');?>}');return false;">{<?php echo localize('booking_date');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#bookingEmailLayout').summernote('insertText','{<?php echo localize('service');?>}');return false;">{<?php echo localize('service');?>}</a>
            </div>
            <form method="post" target="sp" action="core/update.php" role="form">
              <input type="hidden" name="id" value="1">
              <input type="hidden" name="t" value="config">
              <input type="hidden" name="c" value="bookingEmailLayout">
              <textarea id="bookingEmailLayout" class="form-control summernote" name="da" role="textbox"><?php echo rawurldecode($config['bookingEmailLayout']);?></textarea>
            </form>
          </div>
        </div>
        <hr/>
        <legend><?php echo localize('AutoReply Email');?></legend>
        <div class="help-block text-right"><small><?php echo localize('Tokens');?>:</small> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingAutoReplySubject','{<?php echo localize('business');?>}');return false;">{<?php echo localize('business');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingAutoReplySubject','{<?php echo localize('name');?>}');return false;">{<?php echo localize('name');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingAutoReplySubject','{<?php echo localize('first');?>}');return false;">{<?php echo localize('first');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingAutoReplySubject','{<?php echo localize('last');?>}');return false;">{<?php echo localize('last');?>}</a> 
          <a class="badge badge-secondary" href="#" onclick="insertAtCaret('bookingAutoReplySubject','{<?php echo localize('date');?>}');return false;">{<?php echo localize('date');?>}</a>
        </div>
        <div class="form-group row">
          <label for="bookingAutoReplySubject" class="col-form-label col-sm-2"><?php echo localize('Subject');?></label>
          <div class="input-group col-sm-10">
            <?php echo$user['rank']>899?'<div class="input-group-prepend" data-tooltip="tooltip" title="'.localize('Fingerprint Analysis').'"><button class="btn btn-secondary fingerprint" data-dbgid="bookingAutoReplySubject" role="button" aria-label="'.localize('aria_fingerprintanalysis').'">'.svg2('libre-gui-fingerprint').'</button></div>':'';?>
            <input type="text" id="bookingAutoReplySubject" class="form-control textinput" value="<?php echo$config['bookingAutoReplySubject'];?>" data-dbid="1" data-dbt="config" data-dbc="bookingAutoReplySubject" role="textbox">
            <div class="input-group-append" data-tooltip="tooltip" title="<?php echo localize('Save');?>"><button id="savebookingAutoReplySubject" class="btn btn-secondary save" data-dbid="bookingAutoReplySubject" data-style="zoom-in" role="button" aria-label="<?php echo localize('aria_save');?>"><?php svg('libre-gui-save');?></button></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="bookingAttachment" class="col-form-label col-sm-2"><?php echo localize('File Attachment');?></label>
          <div class="input-group col-sm-10">
            <?php echo$user['rank']>899?'<div class="input-group-prepend"><button class="btn btn-secondary fingerprint" data-dbgid="bookingAttachment" data-tooltip="tooltip" title="'.localize('Fingerprint Analysis').'" role="button" aria-label="'.localize('aria_fingerprintanalysis').'">'.svg2('libre-gui-fingerprint').'</button></div>':'';?>
            <input type="text" id="bookingAttachment" class="form-control" name="feature_image" value="<?php echo$config['bookingAttachment'];?>" data-dbid="1" data-dbt="config" data-dbc="bookingsAttachment" readonly role="textbox">
            <div class="input-group-append"><button class="btn btn-secondary" onclick="elfinderDialog('1','config','bookingAttachment');" data-tooltip="tooltip" title="<?php echo localize('Open Media Manager');?>" role="button" aria-label="<?php echo localize('aria_file_mediamanager');?>"><?php svg('libre-gui-browse-media');?></button></div>
            <div class="input-group-append"><button class="btn btn-secondary trash" onclick="coverUpdate('1','config','bookingAttachment','');" data-tooltip="tooltip" title="<?php echo localize('Delete');?>" role="button" aria-label="<?php echo localize('aria_delete');?>"><?php svg('libre-gui-trash');?></button></div>
          </div>
        </div>
        <div class="form-group row">
          <label for="bookingAutoReplyLayout" class="col-form-label col-sm-2"><?php echo localize('Layout');?></label>
          <div class="input-group card-header col-sm-10 p-0">
            <?php echo$user['rank']>899?'<button class="btn btn-secondary btn-sm fingerprint" data-dbgid="barl" data-tooltip="tooltip" title="'.localize('Fingerprint Analysis').'" role="button" aria-label="'.localize('aria_fingerprintanalysis').'">'.svg2('libre-gui-fingerprint').'</button> <div id="barl" data-dbid="1" data-dbt="config" data-dbc="bookingAutoReplyLayout"></div>':'';?>
            <div class="col text-right"><small><?php echo localize('Tokens');?>:</small> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('business');?>}');return false;">{<?php echo localize('business');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('name');?>}');return false;">{<?php echo localize('name');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('first');?>}');return false;">{<?php echo localize('first');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('last');?>}');return false;">{<?php echo localize('last');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('date');?>}');return false;">{<?php echo localize('date');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('booking_date');?>}');return false;">{<?php echo localize('booking_date');?>}</a> 
              <a class="badge badge-secondary" href="#" onclick="$('#orderEmailLayout').summernote('insertText','{<?php echo localize('service');?>}');return false;">{service}</a>
            </div>
            <form method="post" target="sp" action="core/update.php" role="form">
              <input type="hidden" name="id" value="1">
              <input type="hidden" name="t" value="config">
              <input type="hidden" name="c" value="bookingAutoReplyLayout">
              <textarea id="orderEmailLayout" class="form-control summernote" name="da" role="textbox"><?php echo rawurldecode($config['bookingAutoReplyLayout']);?></textarea>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

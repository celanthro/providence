<?php
/* ----------------------------------------------------------------------
 * bundles/ca_attribute_references.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
 
	$vs_id_prefix 				= 	$this->getVar('placement_code').$this->getVar('id_prefix');
	$t_instance 				=	$this->getVar('t_instance');
	$t_element					=	$this->getVar('t_element');
		
	$va_settings 				= 	$this->getVar('settings');
	$vb_batch					=	$this->getVar('batch');
	
	$va_references				= 	$this->getVar('reference_list');
	
	// generate list of inital form values; the bundle Javascript call will

	
	// bundle settings
	
	if ($vb_batch) {
		print caBatchEditorAttributeModeControl($vs_id_prefix);
	} else {
		print caEditorBundleShowHideControl($this->request, $vs_id_prefix);
	}
	
	print caEditorBundleMetadataDictionary($this->request, $vs_id_prefix, $va_settings);
?>
<div id="<?php print $vs_id_prefix; ?>" <?php print $vb_batch ? "class='editorBatchBundleContent'" : ''; ?>>
	<div class="bundleContainer">
		<div class="caItemList">
			<div id="<?php print $vs_id_prefix; ?>Item_1" class="labelInfo">	
<?php
	foreach($va_references as $vn_table_num => $va_refs) {
		if (!($t_instance = $this->request->datamodel->getInstanceByTableNum($vn_table_num, true))) { continue; }
		print "<h3>".$t_instance->getProperty('NAME_PLURAL')."</h3>\n";
		
		if (!($qr_refs = caMakeSearchResult($t_instance->tableName(), array_keys($va_refs)))) { continue; }
		print "<ul>\n";
		while($qr_refs->nextHit()) {
			print "<li>".$qr_refs->getWithTemplate("<l>^ca_objects.preferred_labels.name</l>")."</li>\n";
		}
		print "</ul>\n";
	}
?>
			</div>
		</div>

	</div>
</div>
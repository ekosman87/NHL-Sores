<?php
include_once "/opt/fpp/www/common.php";
include_once 'functions.inc.php';

$pluginName = basename(dirname(__FILE__));
$pluginConfigFile = $settings['configDirectory'] ."/plugin." .$pluginName;
    
if (file_exists($pluginConfigFile)) {
  $pluginSettings = parse_ini_file($pluginConfigFile);
}

//set defaults if nothing saved
if (strlen(urldecode($pluginSettings['nflTeamID']))<1){
  WriteSettingToFile("nflTeamID",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['nflGoalSequence']))<1){
  WriteSettingToFile("nflGoalSequence",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['nflFieldgoalSequence']))<1){
  WriteSettingToFile("nflFieldgoalSequence",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['nflWinSequence']))<1){
  WriteSettingToFile("nflWinSequence",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['ncaaTeamID']))<1){
  WriteSettingToFile("ncaaTeamID",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['ncaaGoalSequence']))<1){
  WriteSettingToFile("ncaaGoalSequence",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['ncaaFieldgoalSequence']))<1){
  WriteSettingToFile("ncaaFieldgoalSequence",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['ncaaWinSequence']))<1){
  WriteSettingToFile("ncaaWinSequence",urlencode(""),$pluginName);
}
if (strlen(urldecode($pluginSettings['logLevel']))<1){
  WriteSettingToFile("logLevel",urlencode("4"),$pluginName);
}

foreach ($pluginSettings as $key => $value) { 
  ${$key} = urldecode($value);
}

?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <style>
    #bodyWrapper {
      background-color: #20222e;
    }
    .pageContent {
      background-color: #171720;
    }
    .plugin-body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: rgb(238, 238, 238);
      background-color: rgb(0, 0, 0);
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      padding-bottom: 2em;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: top center;
      background-size: auto 100%;
    }
    .card {
      background-color: rgba(59, 69, 84, 0.7);
      border-radius: 0.5em;
      margin: 1em 1em 1em 1em;
      padding: 1em 1em 1em 1em;
    }
  </style>
</head>
<body>
  <div class="container-fluid plugin-body">
    <div class="container-fluid pt-4">
      <div class="card">
        <div class="justify-content-md-center row py-3">
          <div class="col-md-auto">
            <h1>NHL Goal Plugin</h1>
          </div>
        </div>
      </div>
    <div class="container-fluid">
      <div class="card">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="nhl-tab" data-bs-toggle="tab" data-bs-target="#nfl" type="button" role="tab" aria-controls="nfl" aria-selected="true">NFL</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="ncaa-tab" data-bs-toggle="tab" data-bs-target="#ncaa" type="button" role="tab" aria-controls="ncaa" aria-selected="false">NCAA</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="nfl" role="tabpanel" aria-labelledby="nfl-tab">
            <div style= "height:100; width:100; margin:auto" class="pt-3">
              <img id="nflLogoImage" src="<?echo $nflTeamLogo;?>" width="100" height ="100">
            </div>
            <!-- NFL Team -->
            <div class="justify-content-md-center row pt-5 py-4">		
              <div class="col-md-6">		  
                <div class="card-title h5">
                  NHL Team
                </div>
                <div class="mb-2 text-muted small h6">
                  Select your NHL team
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">				
                    <? PrintSettingSelect("nflTeamID", "nflTeamID", 0, 0, $defaultValue="", getNFLTeams(), $pluginName, $callbackName = "updateNFLLogo", $changedFunction = "");?>				
                  </div>            
              </div>
            </div>
            <!-- Goal Sequence -->
            <div class="justify-content-md-center row pb-5">
              <div class="col-md-6">
                <div class="card-title h5">
                  Goal Sequence
                </div>
                <div class="mb-2 text-muted small h6">
                  Select the sequence to play on a Goal<br>Select no sequence to disable
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">
                    <? PrintSettingSelect("nflGoalSequence", "nflGoalSequence", 0, 0, $defaultValue="", getSequences(), $pluginName, $callbackName = "", $changedFunction = ""); ?>
                  </div>            
              </div>
            </div>
            <!-- Fieldgoal Sequence -->
            <div class="justify-content-md-center row pb-5">
              <div class="col-md-6">
                <div class="card-title h5">
                  Fieldgoal Sequence
                </div>
                <div class="mb-2 text-muted small h6">
                  Select the sequence to play on a fieldgoal<br>Select no sequence to disable
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">
                    <? PrintSettingSelect("nflFieldgoalSequence", "nflFieldgoalSequence", 0, 0, $defaultValue="", getSequences(), $pluginName, $callbackName = "", $changedFunction = ""); ?>                
                  </div>           
              </div>
            </div>
            <!-- Win Sequence -->
            <div class="justify-content-md-center row pb-5">
              <div class="col-md-6">
                <div class="card-title h5">
                  Win Sequence
                </div>
                <div class="mb-2 text-muted small h6">
                  Select the sequence to play if your team wins<br>Select no sequence to disable
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">
                    <? PrintSettingSelect("nflWinSequence", "nflWinSequence", 0, 0, $defaultValue="", getSequences(), $pluginName, $callbackName = "", $changedFunction = ""); ?>                
                  </div>            
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="ncaa" role="tabpanel" aria-labelledby="ncaa-tab">
            <div style= "height:100; width:100; margin:auto" class="pt-3">
              <img id="ncaaLogoImage" src="<?echo $ncaaTeamLogo;?>" width="100" height ="100">
            </div>
            <!-- NCAA Team -->
            <div class="justify-content-md-center row pt-5 py-4">		
              <div class="col-md-6">		  
                <div class="card-title h5">
                  NCAA Team
                </div>
                <div class="mb-2 text-muted small h6">
                  Select your NCAA team
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">				
                    <? PrintSettingSelect("ncaaTeamID", "ncaaTeamID", 0, 0, $defaultValue="", getNCAATeams(), $pluginName, $callbackName = "updateNCAALogo", $changedFunction = "");?>				
                  </div>            
              </div>
            </div>
            <!-- Goal Sequence -->
            <div class="justify-content-md-center row pb-5">
              <div class="col-md-6">
                <div class="card-title h5">
                  Goal Sequence
                </div>
                <div class="mb-2 text-muted small h6">
                  Select the sequence to play on a Goal<br>Select no sequence to disable
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">
                    <? PrintSettingSelect("ncaaGoalSequence", "ncaaGoalSequence", 0, 0, $defaultValue="", getSequences(), $pluginName, $callbackName = "", $changedFunction = ""); ?>
                  </div>            
              </div>
            </div>
            <!-- Fieldgoal Sequence -->
            <div class="justify-content-md-center row pb-5">
              <div class="col-md-6">
                <div class="card-title h5">
                  Fieldgoal Sequence
                </div>
                <div class="mb-2 text-muted small h6">
                  Select the sequence to play on a fieldgoal<br>Select no sequence to disable
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">
                    <? PrintSettingSelect("ncaaFieldgoalSequence", "ncaaFieldgoalSequence", 0, 0, $defaultValue="", getSequences(), $pluginName, $callbackName = "", $changedFunction = ""); ?>                
                  </div>           
              </div>
            </div>
            <!-- Win Sequence -->
            <div class="justify-content-md-center row pb-5">
              <div class="col-md-6">
                <div class="card-title h5">
                  Win Sequence
                </div>
                <div class="mb-2 text-muted small h6">
                  Select the sequence to play if your team wins<br>Select no sequence to disable
                </div>
              </div>
              <div class="col-md-6">            
                  <div class="input-group">
                    <? PrintSettingSelect("ncaaWinSequence", "ncaaWinSequence", 0, 0, $defaultValue="", getSequences(), $pluginName, $callbackName = "", $changedFunction = ""); ?>                
                  </div>            
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <!-- Enable Plugin -->
            <div class="justify-content-md-center row pt-4">
              <div class="col-md-6">
                <div class="card-title h5">
                  Enable Plugin
                </div>
                <div class="mb-2 text-muted small h6">
                  The plugin is enabled when checked
                </div>
              </div>
              <div class="col-md-6">            
                <div>
                  <?PrintSettingCheckbox("NFLPlugin", "ENABLED", 0, 0, "ON", "OFF", $pluginName ,$callbackName = "setEnabledStatus", $changedFunction = ""); ?>               
                </div>            
              </div>
            </div>
            <!-- Log Level -->
            <div class="justify-content-md-center row">
              <div class="col-md-6">
                <div class="card-title h5">
                  Log Level
                </div>
                <div class="mb-2 text-muted small h6">
                  Info: Logs each sequence played<br>Debug: Logs each poll to ESPN API
                </div>
              </div>
              <div class="col-md-6">            
                <div class="input-group">
                  <? PrintSettingSelect("logLevel", "logLevel", 0, 0, $defaultValue="", Array("Info" => "4", "Debug" => "5"), $pluginName, $callbackName = "", $changedFunction = ""); ?>               
                </div>            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
  
  function updateNFLLogo(){
		
	$.ajax({ 
		url: 'plugin.php?_menu=status&plugin=fpp-nfl&nopage=1&page=functions.inc.php',
        data: {action: 'getNFLLogo'},
        type: 'post',
        success: function(output) {
            $.ajax({ 
			url: 'api/plugin/fpp-nfl/settings/nflTeamLogo',       
			type: 'get',
			success: function(data) {		
				var logo= data.nflTeamLogo;
				document.getElementById('nflLogoImage').src = logo;					
			}
		});
        }
	});
		
  }
  function updateNCAALogo(){
		
    $.ajax({ 
      url: 'plugin.php?_menu=status&plugin=fpp-nfl&nopage=1&page=functions.inc.php',
          data: {action: 'getNCAALogo'},
          type: 'post',
          success: function(output) {
              $.ajax({ 
        url: 'api/plugin/fpp-nfl/settings/ncaaTeamLogo',       
        type: 'get',
        success: function(data) {		
          var logo= data.ncaaTeamLogo;
          document.getElementById('ncaaLogoImage').src = logo;					
        }
      });
          }
    });
      
    }
  function setEnabledStatus(){
	$.ajax({ 
		url: 'plugin.php?_menu=status&plugin=fpp-nfl&nopage=1&page=nfl.php',
		type: 'post',
        success: function(result) {
			console.log (result);
		}
           
		
       
	});
		
   
  }
  </script>
 
</body>
</html>

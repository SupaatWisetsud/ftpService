<?php 
function add_ftp_user ($userid, $password, $dir) {

    $filezilla = 'C:\xampp\FileZillaFTP\FileZilla Server.xml';

    /*** create a SimpleXML object ***/ 
    if( ! $xml = simplexml_load_file($filezilla) ){ 
        echo "Unable to load XML file"; 
    }else{ 
        // print_r($xml->Users);
        $user = $xml->Users->addChild('User');
        $user->addAttribute('Name', $userid);
        
        $option = $user->addChild('Option', md5($password));
        $option->addAttribute('Name', 'Pass');
        
        $option = $user->addChild('Option', '');
        $option->addAttribute('Name', 'Group');

        $option = $user->addChild('Option', '0');
        $option->addAttribute('Name', 'Bypass server userlimit');

        $option = $user->addChild('Option', '0');
        $option->addAttribute('Name', 'User Limit');

        $option = $user->addChild('Option', '0');
        $option->addAttribute('Name', 'IP Limit');

        $option = $user->addChild('Option', '1');
        $option->addAttribute('Name', 'Enabled');

        $option = $user->addChild('Option', '');
        $option->addAttribute('Name', 'Comments');

        $option = $user->addChild('Option', '0');
        $option->addAttribute('Name', 'ForceSsl');

        $filter = $user->addChild('IpFilter');
        $filter->addChild('Disallowed');
        $filter->addChild('Allowed');

        $premissions = $user->addChild('Permissions');
        $premission = $premissions->addChild('Permission');
        $premission->addAttribute('Dir', $dir);

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'FileRead');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'FileWrite');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'FileDelete');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'FileAppend');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'DirCreate');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'DirDelete');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'DirList');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'DirSubdirs');

        $option = $premission->addChild('Option', '1');
        $option->addAttribute('Name', 'IsHome');

        $option = $premission->addChild('Option', '0');
        $option->addAttribute('Name', 'AutoCreate');
        
        $speed = $user->addChild('SpeedLimits');
        $speed->addAttribute('DlType', '0');
        $speed->addAttribute('DlLimit', '10');
        $speed->addAttribute('ServerDlLimitBypass', '0');
        $speed->addAttribute('UlType', '0');
        $speed->addAttribute('UlLimit', '10');
        $speed->addAttribute('ServerUlLimitBypass', '0');
        $speed->addChild('Download');
        $speed->addChild('Upload');

        $xml->asXML($filezilla);
    } 
}
?>
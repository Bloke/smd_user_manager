<?php

// This is a PLUGIN TEMPLATE for Textpattern CMS.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'smd_user_manager';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.21';
$plugin['author'] = 'Stef Dawson';
$plugin['author_uri'] = 'http://stefdawson.com/';
$plugin['description'] = 'Manage user accounts, groups and privileges';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '8';

// Plugin 'type' defines where the plugin is loaded
// 0 = public              : only on the public side of the website (default)
// 1 = public+admin        : on both the public and admin side
// 2 = library             : only when include_plugin() or require_plugin() is called
// 3 = admin               : only on the admin side (no AJAX)
// 4 = admin+ajax          : only on the admin side (AJAX supported)
// 5 = public+admin+ajax   : on both the public and admin side (AJAX supported)
$plugin['type'] = '5';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '3';

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

$plugin['textpack'] = <<<EOT
#@smd_um
smd_um_active => Users currently active: 
smd_um_active_timeout => Activity timeout (seconds)
smd_um_admin_group => Protected administrator group
smd_um_article_count => Articles
smd_um_based_on => based on
smd_um_chp_lbl => Change pass
smd_um_file_count => Files
smd_um_grp_affected => . Users affected: {num}
smd_um_grp_created => Group "{name}" created
smd_um_grp_deleted => Group deleted
smd_um_grp_exists => Group already exists as priv ID {id}
smd_um_grp_lbl => Groups
smd_um_grp_new => New group title
smd_um_grp_new_name => name
smd_um_grp_saved => Group info updated
smd_um_heading_grp => User groups
smd_um_heading_prf => User manager settings
smd_um_heading_prv => User privileges
smd_um_heading_usr => User management
smd_um_hierarchical_groups => Assume hierarchical groups (levels)
smd_um_image_count => Images
smd_um_link_count => Links
smd_um_max_search_limit => Maximum user search result limit
smd_um_name_required => A name is required
smd_um_new_user => New user
smd_um_pass_change_error => Password NOT saved
smd_um_pass_length => Password length (characters)
smd_um_prf_lbl => Prefs
smd_um_prv_created => Priv area "{area}" created
smd_um_prv_exists => Priv area already exist
smd_um_prv_lbl => Privs
smd_um_prv_new => New priv area
smd_um_prv_saved => Privs updated
smd_um_prv_smd_um => Cannot create privs for smd_user_manager
smd_um_reset => [R]
smd_um_self_alter => Allow smd_um privs to be altered
smd_um_sel_all => Select the entire area then (c)heck, (u)ncheck or (t)oggle highlighted checkboxes
smd_um_sel_grp => Select this group then (c)heck, (u)ncheck or (t)oggle highlighted checkboxes
smd_um_sel_prv => Select this area set then (c)heck, (u)ncheck or (t)oggle highlighted checkboxes
smd_um_sel_reset => Reset: any checked area sets will revert to their defaults after Save
smd_um_settings => Settings
smd_um_tab_name => User manager
smd_um_tbl_installed => Tables installed
smd_um_tbl_not_installed => Tables not installed
smd_um_tbl_not_removed => Tables not removed
smd_um_tbl_removed => Tables removed
smd_um_user_count => Users in this group: 
smd_um_usr_lbl => Users
#@smd_um
#@language fr-fr
smd_um_active => Utilisateurs actuellement actifs :&nbsp;
smd_um_active_timeout => Durée d'activité (secondes)
smd_um_admin_group => Groupe protégé d'administrateurs
smd_um_article_count => Articles
smd_um_based_on => basé sur
smd_um_chp_lbl => Changer le mot de passe
smd_um_file_count => Fichiers
smd_um_grp_affected => . Utilisateurs affectés : {num}
smd_um_grp_created => Groupe "{name}" créé
smd_um_grp_deleted => Groupe supprimé
smd_um_grp_exists => Ce groupe existe déjà sous l'ID {id}
smd_um_grp_lbl => Groupes
smd_um_grp_new => Titre du nouveau groupe
smd_um_grp_new_name => nom
smd_um_grp_saved => Infos du groupe mises à jour
smd_um_heading_grp => Groupe d'utilisateurs
smd_um_heading_prf => Paramètres utilisateurs
smd_um_heading_prv => Privilèges utilisateurs
smd_um_heading_usr => Gestion des utilisateurs
smd_um_hierarchical_groups => Chargé de la hiérarchie des groupes (levels)
smd_um_image_count => Images
smd_um_link_count => Liens
smd_um_max_search_limit => Résultats des recherches utilisateurs maxi
smd_um_name_required => Un nom est requis
smd_um_new_user => Nouvel utilisateur
smd_um_pass_change_error => Mot de passe NON enregistré
smd_um_pass_length => Longueur du mot de passe (caractères)&nbsp;
smd_um_prf_lbl => Préférences
smd_um_prv_created => Définition de privilèges "{area}" créée
smd_um_prv_exists => Cette définition de privilèges existe déjà
smd_um_prv_lbl => Privilèges
smd_um_prv_new => Nouvelle définition de privilège
smd_um_prv_saved => Privilèges mis à jour
smd_um_prv_smd_um => Impossible de créer les privilèges pour smd_user_manager
smd_um_reset => [R]
smd_um_self_alter => Accès aux privilèges de smd_um
smd_um_sel_all => Sélectionnez la zone entière puis cocher (c), décocher (u) ou basculer les cases en surbrillance (t)
smd_um_sel_grp => Sélectionnez le groupe puis cocher (c), décocher (u) ou basculer les cases en surbrillance (t)
smd_um_sel_prv => Sélectionnez la zone puis cocher (c), décocher (u) ou basculer les cases en surbrillance (t)
smd_um_sel_reset => Réinitialiser : toutes les sélections verront leurs réglages rétablis par défaut après enregistrement
smd_um_settings => Paramètres
smd_um_tab_name => Gestion utilisateurs
smd_um_tbl_installed => Tables installées
smd_um_tbl_not_installed => Tables non installées
smd_um_tbl_not_removed => Tables non supprimées
smd_um_tbl_removed => Tables supprimées
smd_um_user_count => Utilisateurs de ce groupe :&nbsp;
smd_um_usr_lbl => Utilisateurs
#@smd_um
#@language es-es
smd_um_active => Usuarios actualmente conectados:
smd_um_active_timeout => Desconectar a los usuarios después de (segundos)
smd_um_admin_group => Grupo protegido de administradores
smd_um_article_count => Artículos
smd_um_based_on => basado en
smd_um_chp_lbl => Cambiar contraseña
smd_um_file_count => Ficheros
smd_um_grp_affected => . Usuarios afectados: {num}
smd_um_grp_created => Grupo "{name}" creado
smd_um_grp_deleted => Grupo eliminado
smd_um_grp_exists => El grupo ya existe, su ID de privilegios es {id}
smd_um_grp_lbl => Grupos
smd_um_grp_new => Nuevo nombre de grupo
smd_um_grp_new_name => nombre
smd_um_grp_saved => Información de grupo actualizada
smd_um_heading_grp => Grupos de usuarios
smd_um_heading_prf => Preferencias del gestor de usuarios
smd_um_heading_prv => Privilegios de usuarios
smd_um_heading_usr => Gestión de usuarios
smd_um_hierarchical_groups => Asumir grupos jerárquicos (niveles)
smd_um_image_count => Imágenes
smd_um_link_count => Enlaces
smd_um_max_search_limit => Límite máximo de resultados en búsqueda de usuarios
smd_um_name_required => Se requiere un nombre
smd_um_new_user => Nuevo usuario
smd_um_pass_change_error => Contraseña NO guardada
smd_um_pass_length => Longitud de contraseña (caracteres)
smd_um_prf_lbl => Preferencias
smd_um_prv_created => Área de privilegios "{area}" creada
smd_um_prv_exists => Área de privilegios ya existe
smd_um_prv_lbl => Privilegios
smd_um_prv_new => Nuevo área de privilegios
smd_um_prv_saved => Privilegios actualizados
smd_um_prv_smd_um => Imposible crear privilegios para smd_user_manager
smd_um_reset => [R]
smd_um_self_alter => Permitir cambiar privilegios a smd_um
smd_um_sel_all => Selecciona esta área completa, luego marca (c), desmarca (u) o invierte (t) la selección
smd_um_sel_grp => Selecciona este grupo, luego marca (c), desmarca (u) o invierte (t) la selección
smd_um_sel_prv => Selecciona este área, luego marca (c), desmarca (u) o invierte (t) la selección
smd_um_sel_reset => Reajustar: todas las áreas marcadas volverán a sus valores por defecto después de guardar
smd_um_settings => Preferencias
smd_um_tab_name => Gestor de usuarios
smd_um_tbl_installed => Tablas instaladas
smd_um_tbl_not_installed => Tablas no instaladas
smd_um_tbl_not_removed => Tablas no eliminadas
smd_um_tbl_removed => Tablas eliminadas
smd_um_user_count => Usuarios en este grupo:
smd_um_usr_lbl => Usuarios
EOT;

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
//<?php
/**
 * smd_user_manager
 *
 * A Textpattern CMS plugin for complete user administration:
 *  -> Search / filter / alter info on users (with asset counts)
 *  -> Create / alter groups (roles)
 *  -> Create / customise privs (areas)
 *  -> Online user list
 *
 * @author Stef Dawson
 * @link   http://stefdawson.com/
 */
// TODO:
//  -> Why does multi-edit fire twice? Is it still attached to the Admin->Users table?

if (!defined('SMD_UM_PRIVS')) {
    define("SMD_UM_PRIVS", 'smd_um_privs');
}
if (!defined('SMD_UM_GROUPS')) {
    define("SMD_UM_GROUPS", 'smd_um_groups');
}

if(@txpinterface === 'admin') {
    global $smd_um_event, $txp_permissions, $txp_groups, $txp_user, $step;

    $smd_um_event = 'smd_um';

    add_privs($smd_um_event.'.usr.list', '1, 2, 3');
    add_privs($smd_um_event.'.usr.edit', '1, 2');
    add_privs($smd_um_event.'.usr.create', '1');
    add_privs($smd_um_event.'.grp', '1');
    add_privs($smd_um_event.'.prv', '1');
    add_privs($smd_um_event.'.prf', '1');
    add_privs('plugin_prefs.smd_user_manager', '1');
    register_tab('admin', $smd_um_event, gTxt('smd_um_tab_name'));
    register_callback('smd_um_silence', 'admin');
    register_callback('smd_um_dispatcher', $smd_um_event);
    register_callback('smd_um_dispatcher', $smd_um_event.'.usr.edit.own');
    register_callback('smd_um_users_tab', 'admin_side', 'head_end');
    register_callback('smd_um_prefs', 'plugin_prefs.smd_user_manager');
    register_callback('smd_um_welcome', 'plugin_lifecycle.smd_user_manager');
    register_callback('smd_um_inject_css', 'admin_side', 'head_end');

    // Log the time of this access attempt
    $curr_users = unserialize(get_pref('smd_um_current_users', ''));
    $curr_users[$txp_user] = time();
    set_pref('smd_um_current_users', serialize($curr_users), 'smd_um', PREF_HIDDEN, '', 0);

    // Merge in the groups only for now
    smd_um_priv_merge(1, 0);
    include_once txpath.'/lib/txplib_admin.php';

    // Permit user self-editing
    $smd_um_grps = array_keys(smd_um_get_groups(0));

    unset($smd_um_grps[0]); // Remove None user
    $allprivs = join(',',$smd_um_grps);
    add_privs($smd_um_event, $allprivs); // Required to display anything at all on the User Manager tab
    add_privs($smd_um_event.'.usr.edit.own', $allprivs);

    // Now the privs are established for all admin steps so we can go ahead
    // and merge in the changes. One caveat: if we're saving the privs we
    // need to delay the database merge until after the resets have been applied,
    // otherwise we won't know what the defaults (in admin_config.php) are
    $do_privs = (($step === 'smd_um_privs') && ps('smd_um_priv_save')) ? 0 : 1;
    smd_um_priv_merge(0, $do_privs);
}

// ********************
// ADMIN SIDE INTERFACE
// ********************

// -------------------------------------------------------------
// CSS definitions: hopefully kind to themers
// Includes a hack for Remora (#nav li ul) to prevent menu from disappearing under the
// privs content. This only occurs because the .smd_um_privgroup class uses position:relative.
// Needs workaround as it affects other plugins.
function smd_um_get_style_rules() {
    $smd_um_styles = array(
        'control-panel' => '
.smd_um_privgroup { margin:10px auto; width:50%; position:relative; }
.smd_um_privgroup h3 { text-align:left; font-weight:bold; }
.smd_um_privsave { position:absolute; left:-55px; top:0; }
.smd_um_active_users { margin:15px auto; width:80%; text-align:center; }
.smd_um_selected { background-color:#e2dfce; }
.smd_um_grp_name, .smd_um_prv_name, .smd_um_reset_col { cursor:pointer; }
.smd_um_checkbox, .smd_um_prv_hdr { text-align:center!important; }
#nav li ul { z-index:10000; }
',
    );

    return $smd_um_styles;
}

// -------------------------------------------------------------
function smd_um_inject_css($evt, $stp) {
    global $smd_um_event, $event;

    if ($event == $smd_um_event || $event == 'admin') {
        $smd_um_styles = smd_um_get_style_rules();

        echo '<style type="text/css">', $smd_um_styles['control-panel'], '</style>';
    }

    return;
}


// -------------------------------------------------------------
// Destroy the existing Admin->Users tab if we come from any smd_um-initiated step
function smd_um_silence($evt, $stp) {
    global $event, $smd_um_event;

    $ignore = array(
        'author_list',
        'author_edit',
        'author_save',
        'author_save_new',
        'change_pass',
    );

    $no_dispatch = array(
        'change_pass',
    );

    if (!in_array($stp, $ignore)) {
        ob_end_clean(); // Kill any existing Admin tab panel...
        ob_start(); // ... and start again
        $event = $smd_um_event;

        if (!in_array($stp, $no_dispatch)) {
            smd_um_dispatcher($event, $stp);
        }
    }
}

// -------------------------------------------------------------
// Plugin jump off point
function smd_um_dispatcher($evt, $stp, $msg='') {
    global $smd_um_event, $txp_permissions, $txp_user;

    $available_steps = array(
        'smd_um'                  => false,
        'smd_um_edit'             => false,
        'smd_um_save'             => true,
        'smd_um_save_new'         => true,
        'smd_um_groups'           => false,
        'smd_um_privs'            => false,
        'smd_um_prefs'            => false,
        'smd_um_multi_edit'       => true,
        'smd_um_change_pass'      => true,
        'smd_um_change_pass_form' => false,
        'smd_um_change_pageby'    => true,
        'smd_um_table_install'    => true,
        'smd_um_table_remove'     => true,
        'save_pane_state'         => true,
    );

    if (!has_privs($smd_um_event.'.usr.list')) {
        $stp = ($stp) ? $stp : 'smd_um_edit';
        $uid = safe_field('user_id', 'txp_users', "name='" . doSlash($txp_user) . "'");
        if ($uid) {
            // Inject this value so the edit step picks it up and edits only the current user.
            // The edit/save steps will verify if the current user is the one trying to be edited
            // to prevent people adding &user_id=N to the URL
            $_POST['user_id'] = $uid;
        }
   }

    if ($stp == 'save_pane_state') {
        smd_um_save_pane_state();
    } else if ($stp && bouncer($stp, $available_steps)) {
        if ($msg) {
            $stp($msg);
        } else {
            $stp();
        }
    } else {
        $smd_um_event($msg);
    }
}

// ------------------------
// Try to hide the Admin->Users tab in the secondary nav via jQuery.
// May fail with inventive DOM structures / themes
// (note to self: campaign for improvement in this area because jQuery smells hackish)
function smd_um_users_tab() {
    global $event;

    $userStr = gTxt('tab_site_admin');
    echo script_js(<<<EOJS
jQuery(function() {
    jQuery("a[href='?event=admin']").each(function() {
        me = jQuery(this);
        if (me.text() == "{$userStr}") {
            me.parent().hide();
        }
    });
    if ('{$event}' == 'admin') {
        jQuery("a[href='?event=smd_um']").each(function() {
            me = jQuery(this);
            me.parent().removeClass('inactive').addClass('active'); // Hive, etc
            me.removeClass('tabdown').addClass('tabup'); // Classic, etc
        });
    }
});
EOJS
    );
}

// ------------------------
function smd_um_welcome($evt, $stp) {
    $msg = '';
    switch ($stp) {
        case 'installed':
            smd_um_table_install(0);
            $msg = 'Super duper users!';
            break;
        case 'deleted':
            smd_um_table_remove(0);
            break;
    }
    return $msg;
}

// ------------------------
// Main user display list
function smd_um($msg='') {
    global $step, $smd_um_event, $txp_user, $smd_um_list_pageby;

    require_privs($smd_um_event.'.usr.list');

    $smd_um_prefs = smd_um_get_prefs();

    if (!smd_um_table_exist(1)) {
        smd_um_table_install(0);
    }

    pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_usr_lbl'), $msg);

    extract(gpsa(array('page', 'sort', 'dir', 'crit', 'search_method')));
    if ($sort === '') $sort = get_pref('smd_um_sort_column', 'login');
    if ($dir === '') $dir = get_pref('smd_um_sort_dir', 'desc');
    $dir = ($dir == 'asc') ? 'asc' : 'desc';

    switch ($sort) {
        case 'real_name':
            $sort_sql = 'RealName '.$dir.', last_access desc';
        break;

        case 'email':
            $sort_sql = 'email '.$dir.', last_access desc';
        break;

        case 'privs':
            $sort_sql = 'privs '.$dir.', last_access desc';
        break;

        case 'article_count':
            $sort_sql = 'article_count '.$dir.', last_access desc';
        break;

        case 'image_count':
            $sort_sql = 'image_count '.$dir.', last_access desc';
        break;

        case 'file_count':
            $sort_sql = 'file_count '.$dir.', last_access desc';
        break;

        case 'link_count':
            $sort_sql = 'link_count '.$dir.', last_access desc';
        break;

        case 'last_login':
            $sort_sql = 'last_access '.$dir;
        break;

        default:
            $sort = 'name';
            $sort_sql = 'name '.$dir.', last_access desc';
        break;
    }

    set_pref('smd_um_sort_column', $sort, 'smd_um', PREF_HIDDEN, '', 0, PREF_PRIVATE);
    set_pref('smd_um_sort_dir', $dir, 'smd_um', PREF_HIDDEN, '', 0, PREF_PRIVATE);

    $switch_dir = ($dir == 'desc') ? 'asc' : 'desc';

    $criteria = 1;

    $count_columns = array('article_count', 'image_count', 'file_count', 'link_count');

    if ($search_method and $crit != '') {
        $crit_escaped = doSlash(str_replace(array('\\','%','_','\''), array('\\\\','\\%','\\_', '\\\''), $crit));

        // Permit searching by privilege name (sort of)
        if ($search_method == 'privileges' && !is_numeric($crit_escaped)) {
            $levels = get_groups();
            foreach ($levels as $idx => $group) {
                if (strpos(strtolower($group), strtolower($crit_escaped)) !== false) {
                    $crit_escaped = $idx;
                    break;
                }
            }
        }

        // Permit <, =, and > operators in count searches.
        // nullcheck is not required for privs searches because the value is a true 0 (whereas in the computed
        // columns it's empty/null)
        $operator = '=';
        $nullcheck = '';
        if (in_array($search_method, $count_columns) || $search_method == 'privileges') {
            preg_match('/([<=>]+)?([0-9]+)/', $crit_escaped, $matches);
            $operator = (isset($matches[1]) && $matches[1] != '') ? $matches[1] : '=';
            $crit_escaped = (isset($matches[2]) && $matches[2] != '') ? $matches[2] : $crit_escaped;
            $char_one = substr($operator, 0, 1);
            $char_two = substr($operator, 1, 1);
            $nullcheck = ($char_one == '<' || ($char_one == '>' && $char_two == '=' && $crit_escaped == '0')) ? ' OR ISNULL('.$search_method.')' : '';
        }

        $critsql = array(
            'login_name'    => "name like '%$crit_escaped%'",
            'real_name'     => "RealName like '%$crit_escaped%'",
            'email'         => "email like '%$crit_escaped%'",
            'privileges'    => "privs $operator '$crit_escaped'",
            'article_count' => "article_count $operator '$crit_escaped'$nullcheck",
            'image_count'   => "image_count $operator '$crit_escaped'$nullcheck",
            'file_count'    => "file_count $operator '$crit_escaped'$nullcheck",
            'link_count'    => "link_count $operator '$crit_escaped'$nullcheck",
        );

        if (array_key_exists($search_method, $critsql)) {
            $criteria = $critsql[$search_method];
            $limit = get_pref('smd_um_max_search_limit', $smd_um_prefs['smd_um_max_search_limit']['default']);
        } else {
            $search_method = '';
            $crit = '';
        }
    } else {
        $search_method = '';
        $crit = '';
    }

    // Since the *_count columns are computed we need to some jiggery pokery here.
    // Thus, if we're looking for counts of 'zero' the actual search value should be isnull()
    if (in_array($search_method, $count_columns) && $operator == '=' && $crit_escaped == '0') {
        $criteria = "ISNULL($search_method)";
    }

    // The fields that make up the real and computed columns
    $fields = '
        txu.user_id,
        txu.name,
        txu.RealName,
        txu.email,
        txu.privs,
        unix_timestamp(txu.last_access) as last_login,
        (
            SELECT
                count(*) AS total
            FROM textpattern
            WHERE AuthorID = txu.name
            GROUP BY AuthorID
        ) AS article_count,
        (
            SELECT
                count(*) AS total
            FROM txp_image
            WHERE author = txu.name
            GROUP BY author
        ) AS image_count,
        (
            SELECT
                count(*) AS total
            FROM txp_file
            WHERE author = txu.name
            GROUP BY author
        ) AS file_count,
        (
            SELECT
                count(*) AS total
            FROM txp_link
            WHERE author = txu.name
            GROUP BY author
        ) AS link_count';
    $clause = ' FROM '.PFX.'txp_users as txu';

    // Perform a count on the relevant search item. Doing a count(*) is awkward due to the computed columns
    // so a straight query is performed with a loop to increment the total. getThing() or getRows for some reason
    // failed under certain conditions
    $total = 0;

    // Call this so plugins that hook into the step can play
    $criteria .= callback_event('admin_criteria', 'author_list', 0, $criteria);

    $totrs = safe_query('SELECT '.$fields.$clause.' HAVING '.$criteria);
    while ($row = nextRow($totrs)) {
        $total++;
    }

    $btnbar = smd_um_buttons('usr');

    echo '<h1 class="txp-heading">', gTxt('smd_um_heading_usr'), '</h1>',
        '<div class="clearfix" id="', $smd_um_event, '_control" class="txp-control-panel">',
        $btnbar;

    if ($total < 1) {
        if ($criteria != 1) {
            echo n, smd_um_search_form($crit, $search_method),
                n, graf(gTxt('no_results_found'), ' class="indicator"'),
                n, '</div>';
        }
        return;
    }

    $limit = max($smd_um_list_pageby, 15);

    list($page, $offset, $numPages) = pager($total, $limit, $page);

    $use_multi_edit = ( has_privs($smd_um_event.'.usr.edit') && (safe_count('txp_users', '1=1') > 1) );

    echo n, smd_um_search_form($crit, $search_method), '</div>';

    // Retrieve the user info and related counts
    $rs = safe_query('SELECT '.$fields.$clause.' HAVING '.$criteria.' ORDER BY '.$sort_sql.' LIMIT '.$offset.', '.$limit);

    if ($rs) {
        echo n, '<div class="txp-container">',
            n, '<form action="index.php" id="smd_um_form" method="post" name="longform" class="multi_edit_form" onsubmit="return verify(\''.gTxt('are_you_sure').'\')">',
            n, '<div class="txp-listtables">',
            n, startTable('', '', 'txp-list'),
            n, '<thead>',
            n, tr(
                n. (($use_multi_edit)
                    ? hCell(fInput('checkbox', 'select_all', 0, '', '', '', '', '', 'select_all'), '', ' title="'.gTxt('toggle_all_selected').'" class="multi-edit"')
                    : hCell('', '', ' class="multi-edit"')
                ).
                n. column_head('login_name', 'name', 'smd_um', true, $switch_dir, $crit, $search_method, (('name' == $sort) ? "$dir " : '').'name login-name').
                n. column_head('real_name', 'real_name', 'smd_um', true, $switch_dir, $crit, $search_method, (('real_name' == $sort) ? "$dir " : '').'name real-name').
                n. column_head('email', 'email', 'smd_um', true, $switch_dir, $crit, $search_method, (('email' == $sort) ? "$dir " : '').'email').
                n. column_head('privileges', 'privs', 'smd_um', true, $switch_dir, $crit, $search_method, (('privs' == $sort) ? "$dir " : '').'privs').
                n. column_head('last_login', 'last_login', 'smd_um', true, $switch_dir, $crit, $search_method, (('last_login' == $sort) ? "$dir " : '').'date last-login modified').
                n. column_head(gTxt('smd_um_article_count'), 'article_count', 'smd_um', true, $switch_dir, $crit, $search_method, (('article_count' == $sort) ? "$dir " : '')).
                n. column_head(gTxt('smd_um_image_count'), 'image_count', 'smd_um', true, $switch_dir, $crit, $search_method, (('image_count' == $sort) ? "$dir " : '')).
                n. column_head(gTxt('smd_um_file_count'), 'file_count', 'smd_um', true, $switch_dir, $crit, $search_method, (('file_count' == $sort) ? "$dir " : '')).
                n. column_head(gTxt('smd_um_link_count'), 'link_count', 'smd_um', true, $switch_dir, $crit, $search_method, (('link_count' == $sort) ? "$dir " : ''))
            ),
            n, '</thead>',
            n, '<tbody>';

        $curr_priv = safe_field('privs', 'txp_users', "name = '" .doSlash($txp_user). "'");

        while ($row = nextRow($rs)) {
            extract(doSpecial($row));

            $permitted = smd_um_can_edit($curr_priv, $name, $privs);

            echo tr(
                td(((has_privs($smd_um_event.'.usr.edit') && $txp_user != $row['name']) ? fInput('checkbox', 'selected[]', $row['name'], 'checkbox') : ''), '', 'multi-edit').
                td( (($permitted) ? eLink($smd_um_event, 'smd_um_edit', 'user_id', $user_id, $name) : $name), '', 'name login-name actions').
                td($RealName, '', 'name real-name').
                td('<a href="mailto:'.$email.'">'.$email.'</a>', '', 'email').
                td(smd_um_get_priv_level($privs), '', 'privs').
                td(($last_login ? safe_strftime('%b&#160;%Y', $last_login) : ''), '', 'date last-login modified').
                td(($article_count) ? eLink('list', 'list', 'search_method', 'author', $article_count, 'crit', $name) : '0').
                td(($image_count) ? eLink('image', 'image_list', 'search_method', 'author', $image_count, 'crit', $name) : '0').
                td(($file_count) ? eLink('file', 'file_list', 'search_method', 'author', $file_count, 'crit', $name) : '0').
                td(($link_count) ? eLink('link', 'link_edit', 'search_method', 'author', $link_count, 'crit', $name) : '0')
            );
        }

        echo n, '</tbody>',
            n, endTable(),
            n, '</div>',
            n, (($use_multi_edit) ? smd_um_multiedit_form($page, $sort, $dir, $crit, $search_method) : ''),
            n, tInput(),
            n, '</form>',
            n, '<div id="users_navigation" class="txp-navigation">',
            n, nav_form('smd_um', $page, $numPages, $sort, $dir, $crit, $search_method, $total, $limit),
            n, pageby_form('smd_um', $smd_um_list_pageby),
            n, '</div>',
            n, smd_um_active_users(),
            n, '</div>';
    }

    // Call the Admin side's author_list routine so other plugins with a vested interest can join the party
    callback_event('admin', 'author_list');
}

// Can this logged-in user edit the given user account?
function smd_um_can_edit($curr_priv, $name, $privs) {
    global $smd_um_event, $txp_user;

    $smd_um_prefs = smd_um_get_prefs();

    $permitted = false; // Assume no editing rights unlesss otherwise stated

    $tiered = get_pref('smd_um_hierarchical_groups', $smd_um_prefs['smd_um_hierarchical_groups']['default']);
    $protected = get_pref('smd_um_admin_group', $smd_um_prefs['smd_um_admin_group']['default']);

    // For some reason checking ($privs != '') doesn't work *shrug*
    if ( ($name != '') && ($privs == 0 || $privs) ) {
        $permitted = has_privs($smd_um_event.'.usr.edit.own') && ($name == $txp_user);
        $can_edit = has_privs($smd_um_event.'.usr.edit');
        if ($can_edit) {
            $permitted |= $can_edit;
            if ($tiered) {
                $permitted &= (($privs >= $curr_priv) || ($privs == 0));
            }
            if ($protected) {
                $permitted &= (($privs != $protected) || ($curr_priv == $protected));
            }
        }
    }

    return $permitted;
}

// ------------------------
// Edit a single User
function smd_um_edit($msg='') {
    global $step, $txp_user, $smd_um_event;

    $vars = array('user_id', 'name', 'RealName', 'email', 'privs');
    extract(gpsa($vars));

    $rs = array();
    $curr_priv = safe_field('privs', 'txp_users', "name = '" .doSlash($txp_user). "'");

    if ($user_id) {
        $user_id = assert_int($user_id);
        $rs = safe_row('*', 'txp_users', "user_id = $user_id");
        extract($rs);
    } else if (!has_privs($smd_um_event.'.usr.create')) {
        // If the current user doesn't have sufficient rights to create new users
        // then this Edit request without user_id is a self-edit
        $rs = safe_row('*', 'txp_users', "name = '" .doSlash($txp_user). "'");
        extract($rs);
    }

    // Check for edit / creation rights
    $permitted = ($user_id) ? smd_um_can_edit($curr_priv, $name, $privs) : has_privs($smd_um_event.'.usr.create');

    if (!$permitted)
        exit(pageTop('Restricted').'<p style="margin-top:3em;text-align:center">'.
            gTxt('restricted_area').'</p>');

    $caption = gTxt(($user_id) ? 'edit_author' : 'add_new_author');

    pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_usr_lbl'), $msg);
    $btnbar = smd_um_buttons('usr');

    echo '<h1 class="txp-heading">', $caption, '</h1>',
        n, '<div class="clearfix" id="', $smd_um_event, '_control" class="txp-control-panel">',
        n, $btnbar,
        n, '</div>',
        n, '<div id="', $smd_um_event.'_container" class="txp-edit">',
        n, form(
            '<div class="txp-edit">'.n.
            inputLabel('login_name', ($user_id ? strong($name) : fInput('text', 'name', $name, '', '', '', INPUT_REGULAR, '', 'login_name')), ($user_id ? '' : 'login_name'), ($user_id ? '' : 'add_new_author')).n.
            inputLabel('real_name', fInput('text', 'RealName', $RealName, '', '', '', INPUT_REGULAR, '', 'real_name'), 'real_name').n.
            inputLabel('login_email', fInput('text', 'email', $email, '', '', '', INPUT_REGULAR, '', 'login_email'), 'email').n.
            inputLabel('privileges', (($txp_user != $name) ? selectInput('privs', smd_um_get_groups(1), $privs) : hInput('privs', $privs).strong(smd_um_get_priv_level($privs))), ($user_id ? '' : 'privileges'), 'about_privileges').n.
            pluggable_ui('author_ui', 'extend_detail_form', '', $rs).n.
            graf(fInput('submit', '', gTxt('save'), 'publish')).
            eInput($smd_um_event).
            ($user_id ? hInput('user_id', $user_id).sInput('smd_um_save') : sInput('smd_um_save_new')).
            '</div>'
        , '', '', 'post', 'edit-form', '', 'user_edit'),
        '</div>';

    // Call the Admin side's author_edit routine so other plugins with a vested interest can join the party
    callback_event('admin', 'author_edit');
}

// ------------------------
// Virtually cloned from Admin->Users
function smd_um_save() {
    global $event, $smd_um_event, $txp_user;

    // Call the Admin side's author_save routine so other plugins can join the party
    callback_event('admin', 'author_save');

    extract(doSlash(psa(array('privs', 'user_id', 'RealName', 'email'))));
    $privs   = assert_int($privs);
    $user_id = assert_int($user_id);
    $name = safe_field('name', 'txp_users', "user_id = $user_id");
    $curr_priv = safe_field('privs', 'txp_users', "name = '" .doSlash($txp_user). "'");

    // Check for hacking attempts
    $permitted = smd_um_can_edit($curr_priv, $name, $privs);

    if (!$permitted)
        exit(pageTop('Restricted').'<p style="margin-top:3em;text-align:center">'.
            gTxt('restricted_area').'</p>');

    if (!is_valid_email($email)) {
        smd_um_edit(array(gTxt('email_required'), E_ERROR));
        return;
    }

    $rs = safe_update('txp_users', "
        privs    = $privs,
        RealName = '$RealName',
        email    = '$email'",
        "user_id = $user_id"
    );

    if ($rs) {
        $msg = gTxt('author_updated', array('{name}' => $RealName));
    } else {
        $msg = '';
    }

    smd_um_dispatcher($event, '', $msg);
}

// ------------------------
// Virtually cloned from Admin->Users
function smd_um_save_new() {
    global $smd_um_event;

    require_privs($smd_um_event.'.usr.create');

    // Call the Admin side's author_save_new routine so other plugins with a vested interest can join the party
    callback_event('admin', 'author_save_new');

    extract(doSlash(psa(array('privs', 'name', 'email', 'RealName'))));

    $smd_um_prefs = smd_um_get_prefs();
    $privs  = assert_int($privs);
    $length = function_exists('mb_strlen') ? mb_strlen($name, '8bit') : strlen($name);

    if ($name and $length <= 64 and is_valid_email($email)) {
        $exists = safe_field('name', 'txp_users', "name = '" .$name. "'");

        if ($exists) {
            smd_um_edit(array(gTxt('author_already_exists', array('{name}' => $name)), E_ERROR));
            return;
        }

        $pass_len = get_pref('smd_um_pass_length', $smd_um_prefs['smd_um_pass_length']['default']);
        $password = generate_password($pass_len);
        $hash = doSlash(txp_hash_password($password));
        $nonce = doSlash(md5(uniqid(mt_rand(), TRUE)));

        $rs = safe_insert('txp_users', "
            privs    = $privs,
            name     = '$name',
            email    = '$email',
            RealName = '$RealName',
            nonce    = '$nonce',
            pass     = '$hash'
        ");

        if ($rs) {
            // TODO: consider cloning send_password() because only people with admin.edit can run it (i.e. Publishers)
            send_password($RealName, $name, $email, $password);
            $msg = gTxt('password_sent_to').sp.$email;
            $smd_um_event($msg);
        } else {
            $msg = array(gTxt('error_adding_new_author'), E_ERROR);
            smd_um_edit($msg);
        }
    } else {
        $msg = array(gTxt('error_adding_new_author'), E_ERROR);
        smd_um_edit($msg);
    }

}

// ------------------------
// Group management panel
function smd_um_groups($msg='') {
    global $smd_um_event, $txp_user, $txp_groups, $txp_permissions;

    require_privs($smd_um_event.'.grp');

    if (!smd_um_table_exist()) {
        smd_um_table_install(0);
    }

    // Handle any form actions
    if (ps('smd_um_group_save')) {
        $excluded = smd_um_get_groups(0);
        $ids = ps('smd_um_group_id');
        $names = ps('smd_um_group_name');
        $titles = ps('smd_um_group_title');

        foreach($ids as $idx => $id) {
            $title = $titles[$idx];
            $name = strtolower(sanitizeForUrl($names[$idx]));
            // Can't create duplicate types
            if (!in_array($name, $excluded)) {
                safe_update(SMD_UM_GROUPS, "name='" . doSlash($name) . "'", "id='" . doSlash($id) . "'");
            }
            smd_um_upsert_lang($title, $name);
        }

        $msg = gTxt('smd_um_grp_saved');

    } else if (ps('smd_um_group_add')) {
        $title = ps('smd_um_new_grp');
        $name = ps('smd_um_new_grp_name');
        $name = ($name == '') ? strtolower(sanitizeForUrl($title)) : $name;
        if ($name) {
            $exists = safe_field('id', SMD_UM_GROUPS, "name='".doSlash($name)."'");
            if ($exists) {
                $msg = array(gTxt('smd_um_grp_exists', array('{id}' => $exists)), E_USER_WARNING);
            } else {
                // It's not atomic but it'll do, given that:
                //  a) normally only one person administers this plugin
                //  b) groups are added one at a time
                $curr_max = safe_field("MAX(id)", SMD_UM_GROUPS, '1=1');
                $new_priv = ($curr_max + 1);
                safe_insert(SMD_UM_GROUPS, "id='" . $new_priv . "', name='" . doSlash($name) . "'");
                smd_um_upsert_lang($title, $name);

                $based_on = ps('smd_um_new_grp_based_on');
                if ($based_on != '') {
                    assert_int($based_on);
                    // Can't rely on the privs being in the database so resort to the (merged) array
                    foreach ($txp_permissions as $area => $privs) {
                        $privs = do_list($privs);
                        if (in_array($based_on, $privs)) {
                            safe_insert(SMD_UM_PRIVS, "area='" . doSlash($area) . "', priv='" . doSlash($new_priv) . "'");
                        }
                    }
                }

                $msg = gTxt('smd_um_grp_created', array('{name}' => $name));
            }
        } else {
            $msg = array(gTxt('smd_um_name_required'), E_ERROR);
        }
    } else if (ps('smd_um_group_del')) {
        $id = str_replace('smd_um_del_', '', ps('smd_um_grp_del'));
        assert_int($id);

        $affected_users = safe_column('user_id', 'txp_users', "privs = '".doSlash($id)."'");
        if ($affected_users) {
            // Set all orphaned users to no privs -- can always assign them a new group from the main screen later
            $ret = safe_update('txp_users', "privs=0", "user_id IN ('". join("','", doSlash($affected_users)) ."')");
        }

        // TODO: double check this isn't a core group?
        $red = safe_delete(SMD_UM_GROUPS, "id='".doSlash($id)."'");

        if ($red) {
            $ret = safe_delete(SMD_UM_PRIVS, "priv='".doSlash($id)."'");
            $msg = gTxt('smd_um_grp_deleted') . ($affected_users ? gTxt('smd_um_grp_affected', array('{num}' => count($affected_users))) : '');
        }
    }

    // Render the page
    pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_grp_lbl'), $msg);
    $btnbar = smd_um_buttons('grp');
    $grouplist = smd_um_get_groups(1);
    unset($grouplist[0]); // Don't want None privs
    $grouplist = selectInput('smd_um_new_grp_based_on', $grouplist, '', true, '', 'smd_um_new_grp_based_on');

    // New group
    echo '<h1 class="txp-heading">', gTxt('smd_um_heading_grp'), '</h1>',
        n, '<div class="clearfix" id="'.$smd_um_event.'_control" class="txp-control-panel">',
        n, $btnbar,
        n, form(
            graf(
                '<label for="smd_um_new_grp">' . gTxt('smd_um_grp_new') . '</label>'
                .n.fInput('text', 'smd_um_new_grp', '', '', '', '', '', '', 'smd_um_new_grp')
                .n.'<label for="smd_um_new_grp_name">' . gTxt('smd_um_grp_new_name') . '</label>'
                .n.fInput('text', 'smd_um_new_grp_name', '', '', '', '', '', '', 'smd_um_new_grp_name')
                .n.'<label for="smd_um_new_grp_based_on">' . gTxt('smd_um_based_on') . '</label>'
                .n.$grouplist
                .n.fInput('submit', 'smd_um_group_add', gTxt('create'))
                .n.eInput($smd_um_event)
                .n.sInput('smd_um_groups')
                )
            , '','','post','search-form'
            ),
        n, '</div>';

    // Retrieve the group info and user counts per privilege level
    $fields = 'smdg.id, smdg.name, smdg.core, txu.total AS user_count';
    $clause = ' FROM '.PFX.'smd_um_groups AS smdg
        LEFT JOIN (SELECT privs, count(privs) AS total FROM '.PFX.'txp_users GROUP BY privs) AS txu ON smdg.id = txu.privs';

    $rs = getRows('SELECT ' . $fields.$clause . ' ORDER BY id');

    if ($rs) {
        echo n, '<div class="plugin-column">',
            n, '<form action="index.php" id="smd_um_grp_form" method="post" name="longform" onsubmit="return verify(\''.gTxt('are_you_sure').'\')">',
            n.'<div class="txp-listtables">'.
            n, startTable('', '', 'txp-list'),
            n, '<thead>',
            n, tr(
                hCell('ID', '', ' class="id"').
                hCell('name', '', ' class="name"').
                hCell('title', '', ' class="name"').
                hCell('', '', '')
            ),
            n, '</thead>',
            n, '<tbody>';

        foreach ($rs as $row) {
            extract(doSpecial($row));
            $user_count = empty($user_count) ? 0 : $user_count;
            $dLink = ($core) ? '&nbsp;' : fInput('submit', 'smd_um_group_del', "×", '', '', 'smd_um_presub(this)', '', '', 'smd_um_del_'.$id)
                .eInput($smd_um_event)
                .sInput('smd_um_groups')
                .tInput();
            echo tr(
                tda(
                    hInput('smd_um_group_id[]', $id)
                    .(($user_count) ? eLink($smd_um_event, '', 'search_method', 'privileges', $id, 'crit', $id) : $id)
                , ' class="id"'
                    .(($user_count) ? ' title="' . gTxt('smd_um_user_count') . $user_count . '"': '')
                )
                .td(fInput('text', 'smd_um_group_name[]', $name), '', 'name')
                .td(fInput('text', 'smd_um_group_title[]', gTxt($name)), '', 'name')
                .td($dLink)
            );
        }

        echo n, '</tbody>',
            n, endTable(),
            n, '</div>',
            n, graf(fInput('submit', 'smd_um_group_save', gTxt('save'), 'publish')),
            n, fInput('hidden', 'smd_um_grp_del', '', '', '', '', '', '', 'smd_um_grp_del'),
            n, eInput($smd_um_event),
            n, sInput('smd_um_groups'),
            n, tInput(),
            n, '</form>',
            n, smd_um_active_users(),
            n, '</div>',
            script_js(<<<EOJS
function smd_um_presub(obj) {
    jQuery('#smd_um_grp_del').val(jQuery(obj).attr('id'));
}
EOJS
            );
    }
}

// ------------------------
// Privs management panel
function smd_um_privs($msg='') {
    global $smd_um_event, $txp_user, $txp_permissions;

    require_privs($smd_um_event.'.prv');

    if (!smd_um_table_exist()) {
        smd_um_table_install(0);
    }

    if (ps('smd_um_priv_save')) {
        $areas = ps('smd_um_areas');
        foreach ($areas as $area) {
            $ar_fakename = str_replace('.', '---', $area);
            $privs = ps($ar_fakename);
            $area = strtolower(sanitizeForPage($area));
            $safe_area = doSlash($area);

            $current_privs = safe_column('priv', SMD_UM_PRIVS, "area='{$safe_area}'");
            $default_privs = isset($txp_permissions[$area]) ? do_list($txp_permissions[$area]) : array();
            $diff_added = array_diff($privs, $default_privs);
            $diff_removed = array_diff($current_privs, $privs);

            // Only alter privs if they differ from what's already stored
            if ($diff_added || $diff_removed) {
                // Delete the old area privs if they exist
                safe_delete(SMD_UM_PRIVS, "area='{$safe_area}'");

                if (is_array($privs)) {
                    foreach ($privs as $priv) {
                        // Reset should always be first in the list since it's the first checkbox col
                        // If reset, don't add the privs again (thus they will be read from admin_config.php)
                        if ($priv == 'smd_um_reset') {
                            break;
                        } else {
                            assert_int($priv);
                            safe_insert(SMD_UM_PRIVS, "area='" . doSlash($area) . "', priv='" . doSlash($priv) . "'");
                        }
                    }
                }
            }
        }

        // Merge the changes into the priv table
        smd_um_priv_merge(0,1);
        $msg = gTxt('smd_um_prv_saved');
    } else if (ps('smd_um_priv_add')) {
        $name = ps('smd_um_new_prv');
        $name = strtolower(sanitizeForPage($name));

        if ($name) {
            if (strpos($name, 'smd_um') === 0) {
                // Can't create privs for this plugin
                $msg = array(gTxt('smd_um_prv_smd_um'), E_USER_WARNING);
            } else {
                $exists = array_key_exists($name, $txp_permissions);
                if ($exists) {
                    $msg = array(gTxt('smd_um_prv_exists'), E_USER_WARNING);
                } else {
                    safe_insert(SMD_UM_PRIVS, "area='" . doSlash($name) . "'");

                    smd_um_priv_merge(0,1);
                    $msg = gTxt('smd_um_prv_created', array('{area}' => $name));
                }
            }
        } else {
            $msg = array(gTxt('smd_um_name_required'), E_ERROR);
        }
    }

    pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_prv_lbl'), $msg);
    $btnbar = smd_um_buttons('prv');

    echo '<h1 class="txp-heading">', gTxt('smd_um_heading_prv'), '</h1>',
        n, '<div class="clearfix" id="'.$smd_um_event.'_control" class="txp-control-panel">',
        n, $btnbar,
        n, form(
            graf(
                '<label for="smd_um_new_prv">' . gTxt('smd_um_prv_new') . '</label>'
                .n.fInput('text', 'smd_um_new_prv', '', '', '', '', '', '', 'smd_um_new_prv')
                .n.fInput('submit', 'smd_um_priv_add', gTxt('create'))
                .n.eInput($smd_um_event)
                .n.sInput('smd_um_privs')
                )
            , '','','post','search-form'
            ),
        n, '</div>';

    $grouplist_name = smd_um_get_groups(0);
    $grouplist_title = smd_um_get_groups(1);

    unset($grouplist_name[0]); // Don't want None privs
    unset($grouplist_title[0]); // Ditto

    $curr_area = '';
    $area_count = 0;
    $thatts = ' class="smd_um_grp_name" title="' . gTxt('smd_um_sel_grp') . '"';
    $headers = '<thead>'.tr(
        hCell('', '', ' class="smd_um_sel_area" title="' . gTxt('smd_um_sel_all') . '"')
        .hCell(gTxt('smd_um_reset'), '', ' class="smd_um_reset_col" title="' . gTxt('smd_um_sel_reset') . '"')
        .hCell(join('</th><th'.$thatts.'>', $grouplist_title), '', $thatts)
    , ' class="smd_um_prv_hdr"'). '</thead>';

    $viz = do_list(get_pref('pane_smd_um_priv_visible'));

    echo script_js(<<<EOJS
function smd_um_presub(obj) {
    jQuery('#smd_um_prv_del').val(jQuery(obj).attr('id'));
}

jQuery.fn.smd_um_rowsel = function(idx) {
    return jQuery('tr:nth-child('+(idx+1)+') td.smd_um_checkbox', this);
}
jQuery.fn.smd_um_colsel = function(idx) {
    return jQuery('tr td:nth-child('+(idx+1)+')', this);
}

// Affect all highlighted checkboxes on keypress
function smd_um_toggleCheckbox(ev) {
    key = ev.keyCode;
    obj = jQuery('.smd_um_selected :checkbox');
    switch(key) {
        case 67:
            // (c)heck selected boxes
            obj.prop('checked', true);
        break;
        case 68:
            // (d)eselect all selected rows/cols
            jQuery('.smd_um_selected, .smd_um_rsel, .smd_um_csel').removeClass('smd_um_selected smd_um_rsel smd_um_csel');
        break;

        case 84:
            // (t)oggle selected boxes
            obj.each(function() {
                cb = jQuery(this);
                if (cb.prop('checked') == true) {
                    cb.prop('checked', false);
                } else {
                    cb.prop('checked', true);
                }
            });
        break;
        case 85:
            // (u)ncheck selected boxes
            obj.prop('checked', false);
        break;
    }
}

jQuery(function() {
    jQuery(document).bind('keyup', smd_um_toggleCheckbox);

    // Row selector
    jQuery('.smd_um_prv_name').click(function() {
        tr = jQuery(this).closest('tr');
        rownum = tr.index();
        obj = jQuery(tr).parent().smd_um_rowsel(rownum);

        // Can't use toggleClass because it would untoggle any cols that were already selected
        if (jQuery(this).hasClass('smd_um_rsel')) {
            obj.removeClass('smd_um_selected');
        } else {
            obj.addClass('smd_um_selected');
        }
        jQuery(this).toggleClass('smd_um_rsel');
    });

    // Column selector
    jQuery('.smd_um_grp_name, .smd_um_reset_col').click(function() {
        colnum = jQuery(this).index();
        tbody = jQuery(this).parent().parent().next('tbody');
        obj = jQuery(tbody).smd_um_colsel(colnum);

        // Can't use toggleClass because it would untoggle any rows that were already selected
        if (colnum > 0) {
            if (jQuery(this).hasClass('smd_um_csel')) {
                obj.removeClass('smd_um_selected');
            } else {
                obj.addClass('smd_um_selected');
            }
        }
        jQuery(this).toggleClass('smd_um_csel');
    });

    // Whole table selector
    jQuery('.smd_um_sel_area').click(function() {
        me = jQuery(this);
        thead = me.parent().parent();
        tbody = thead.next('tbody');
        tbody.toggleClass('smd_um_allsel');
        if (tbody.hasClass('smd_um_allsel')) {
            tbody.find('.smd_um_prv_name').removeClass('smd_um_rsel').click();
            me.nextAll('.smd_um_grp_name').addClass('smd_um_csel');
        } else {
            tbody.find('.smd_um_prv_name').addClass('smd_um_rsel').click();
            me.nextAll('.smd_um_grp_name').removeClass('smd_um_csel');
        }
    });

});
EOJS
    );

    echo n, '<div class="txp-list">',
        n, '<form action="index.php" id="smd_um_privilege_form" method="post" name="longform" onsubmit="return verify(\''.gTxt('are_you_sure').'\')">',
        n, eInput($smd_um_event).sInput('smd_um_privs').tInput();

    foreach ($txp_permissions as $area => $privs) {
        $priv_list = do_list($privs);
        $area_parts = do_list($area, '.');
        if (preg_match('/^([A-Za-z0-9]{3,3})\_/', $area_parts[0], $matches)) {
            // Plugin
            $area_parts[0] = $matches[1];
        }
        // Start of a new area so close the previous one and start a new block
        if ($curr_area != $area_parts[0]) {
            if ($area_count > 0) {
                echo '</tbody>' . endTable() . '</div></div>';
            }
            $area_head = gTxt($area_parts[0]);
            $is_viz = in_array($area_parts[0], $viz);
            $ref = 'smd_um_priv_'.$area_parts[0];
            echo n, '<div class="smd_um_privgroup"><h3 class="txp-summary lever', ($is_viz ? ' expanded' : ''), '"><a href="#', $ref, '">', $area_parts[0], (($area_parts[0] != $area_head) ? ' ('. gTxt($area_parts[0]). ')' : ''), '</a></h3>',
                n, '<div id="', $ref, '" class="toggle" style="display:', ($is_viz ? 'block' : 'none'), '">',
                n, fInput('submit', 'smd_um_priv_save', gTxt('save'), 'smd_um_privsave'),
                n, startTable('', '', 'txp-list'),
                n, $headers,
                n, '<tbody>';
        }

        $privboxes = array();
        $safe_area = str_replace('.', '---', $area).'[]';
        foreach ($grouplist_name as $id => $priv) {
            /// Dots aren't valid characters for a name so replace them now and swap them back upon Save
            $privboxes[] = td(checkbox($safe_area, $id, (in_array($id, $priv_list))), '', 'smd_um_checkbox');
        }

        echo tr(
            tda($area.hInput('smd_um_areas[]', $area), ' class="smd_um_prv_name" title="' . gTxt('smd_um_sel_prv') . '"')
            .td(checkbox($safe_area, 'smd_um_reset', 0), '', 'smd_um_resetbox')
            .join(n, $privboxes)
        );
        $curr_area = $area_parts[0];
        $area_count++;
    }

    echo n, endTable(),
        n, '</div></div>',
        n, fInput('hidden', 'smd_um_prv_del', '', '', '', '', '', '', 'smd_um_prv_del'),
        n, '</form>',
        n, smd_um_active_users(),
        n, '</div>';
}

// -------------------------------------------------------------
function smd_um_wrap_widget($widget) {
    return '<span class="edit-value">'.$widget.'</span>';
}

// ------------------------
// Prefs management panel
function smd_um_prefs($msg='') {
    global $smd_um_event, $txp_user;

    require_privs($smd_um_event.'.prf');

    if (!smd_um_table_exist()) {
        smd_um_table_install(0);
    }

    $smd_um_prefs = smd_um_get_prefs();

    if (ps('smd_um_pref_save')) {
        foreach ($smd_um_prefs as $idx => $prefobj) {
            $val = ps($idx);
            $val = (is_array($val)) ? join(', ', $val) : $val;
            set_pref($idx, doSlash($val), $smd_um_event, $prefobj['type'], $prefobj['html'], $prefobj['position']);
        }

        $msg = gTxt('preferences_saved');
    }

    pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_prf_lbl'), $msg);
    $btnbar = smd_um_buttons('prf');

    echo '<h1 class="txp-heading">', gTxt('smd_um_heading_prf'), '</h1>',
        n, '<div class="clearfix" id="', $smd_um_event, '_control" class="txp-control-panel">', $btnbar, '</div>';

    $out = array();
    $out[] = n.'<div class="plugin-column">';
    $out[] = '<form name="smd_um_prefs" id="smd_um_prefs" action="index.php" method="post">';
    $out[] = eInput($smd_um_event).sInput('smd_um_prefs');

    $last_grp = '';
    foreach ($smd_um_prefs as $idx => $prefobj) {
        if ($last_grp != $prefobj['group']) {
            $out[] = hed(gTxt($prefobj['group']), 2);
        }
        $last_grp = $prefobj['group'];
        $subout = array();
        $label = '<span class="edit-label">'
                .'<label>'.gTxt($idx).'</label>'
                .'</span>';
        $val = get_pref($idx, $prefobj['default'], 1);
        $vis = (isset($prefobj['visible']) && !$prefobj['visible']) ? 'empty' : '';
        switch ($prefobj['html']) {
            case 'text_input':
                $subout[] = smd_um_wrap_widget(fInput('text', $idx, $val, '', '', '', INPUT_REGULAR, '', $idx));
            break;
            case 'textarea':
                $subout[] = text_area($idx, '', '', $val, $idx);
            break;
            case 'yesnoradio':
                $subout[] = smd_um_wrap_widget(yesnoRadio($idx, $val));
            break;
            case 'radioset':
                $subout[] = smd_um_wrap_widget(radioSet($prefobj['content'], $idx, $val));
            break;
            case 'checkboxset':
                $vals = do_list($val);
                $lclout = array();
                foreach ($prefobj['content'] as $cb => $val) {
                    $checked = in_array($cb, $vals);
                    $lclout[] = checkbox($idx.'[]', $cb, $checked). '<label>' . gTxt($val) . '</label>';
                }
                $subout[] = smd_um_wrap_widget(join(n, $lclout));
            break;
            case 'selectlist':
                $subout[] = smd_um_wrap_widget(selectInput($idx, $prefobj['content'][0], $val, $prefobj['content'][1]));
            break;
            default:
                if ( strpos($prefobj['html'], 'smd_um_') !== false && is_callable($prefobj['html']) ) {
                    $subout[] = smd_um_wrap_widget($prefobj['html']($idx, $val));
                }
            break;
        }
        $out[] = graf($label . n.join(n ,$subout), ($vis ? ' class="'.$vis.'"' : ''));
    }
    $out[] = graf(fInput('submit', 'smd_um_pref_save', gTxt('save'), 'publish'));
    $out[] = tInput();
    $out[] = '</form>'.smd_um_active_users().'</div>';

    echo join(n, $out);
}

// ------------------------
// Common buttons for the interface
function smd_um_buttons($curr='usr') {
    global $step, $smd_um_event;

    $grp = has_privs($smd_um_event.'.grp');
    $prf = has_privs($smd_um_event.'.prf');
    $prv = has_privs($smd_um_event.'.prv');
    $new = has_privs($smd_um_event.'.usr.create');
    $usr = ($grp || $prf || $prv); // Don't show usr button if it's the only tab available

    $btns = array (
        'new' => ( ($new) ? sLink($smd_um_event, 'smd_um_edit', gTxt('smd_um_new_user'), 'navlink') : ''),
        'grp' => ( ($grp) ? sLink($smd_um_event, 'smd_um_groups', gTxt('smd_um_grp_lbl'), 'navlink') : ''),
        'prf' => ( ($prf) ? sLink($smd_um_event, 'smd_um_prefs', gTxt('smd_um_prf_lbl'), 'navlink') : ''),
        'prv' => ( ($prv) ? sLink($smd_um_event, 'smd_um_privs', gTxt('smd_um_prv_lbl'), 'navlink') : ''),
        'usr' => ( ($usr) ? sLink($smd_um_event, 'smd_um_list', gTxt('smd_um_usr_lbl'), 'navlink') : ''),
        'chp' => ( sLink($smd_um_event, 'smd_um_change_pass_form', gTxt('change_password'), 'navlink')),
    );

    return graf(
            (($curr == 'usr') ? n. ($step === 'smd_um_edit' ? '' : $btns['chp']) .n. $btns['new'] .n. strong($btns['usr']) : n.$btns['usr'])
            .n.(($curr == 'grp') ? strong($btns['grp']) : $btns['grp'])
            .n.(($curr == 'prv') ? strong($btns['prv']) : $btns['prv'])
            .n.(($curr == 'prf') ? strong($btns['prf']) : $btns['prf'])
        , ' class="txp-buttons"');
}

// ------------------------
// Alter the pageby quantity
function smd_um_change_pageby() {
    global $smd_um_event;
    event_change_pageby('smd_um');
    $smd_um_event();
}

// ------------------------
// The user panel search dropdown list
function smd_um_search_form($crit, $method) {
    global $smd_um_event;

    $methods =  array(
        'login_name'    => gTxt('login_name'),
        'real_name'     => gTxt('real_name'),
        'email'         => gTxt('email'),
        'privileges'    => gTxt('privileges'),
        'article_count' => gTxt('smd_um_article_count'),
        'image_count'   => gTxt('smd_um_image_count'),
        'file_count'    => gTxt('smd_um_file_count'),
        'link_count'    => gTxt('smd_um_link_count'),
    );

    return search_form($smd_um_event, '', $crit, $methods, $method, 'login');
}

// ------------------------
function smd_um_get_priv_level($priv) {
    $levels = get_groups();
    return $levels[$priv];
}

// ------------------------
// Merge/edit the groups & privs into the existing global arrays
function smd_um_priv_merge($do_grp=1, $do_priv=1) {
    global $txp_groups, $txp_permissions;

    $smd_um_prefs = smd_um_get_prefs();

    if ($do_grp && smd_um_table_exist(SMD_UM_GROUPS)) {
        $new_groups = safe_rows('id, name', SMD_UM_GROUPS, '1=1');
        foreach ($new_groups as $row) {
            $txp_groups[$row['id']] = $row['name'];
        }
        ksort($txp_groups);
    }
    if ($do_priv && smd_um_table_exist(SMD_UM_PRIVS)) {
        $new_privs = safe_rows('area, GROUP_CONCAT(priv) AS privs', SMD_UM_PRIVS, '1=1 GROUP BY area ORDER BY area');

        // Allow this plugin's strings to be skipped if we don't want people upsetting the plugin's behaviour
        $self_edit = get_pref('smd_um_self_alter', $smd_um_prefs['smd_um_self_alter']['default']);
        foreach ($new_privs as $row) {
            if (strpos($row['area'], 'smd_um') === false || $self_edit) {
                $txp_permissions[$row['area']] = $row['privs'];
            }
        }
        ksort($txp_permissions);
    }
}

// ------------------------
// Show who's currently online
function smd_um_active_users() {
    global $smd_um_event;

    $smd_um_prefs = smd_um_get_prefs();

    $curr_users = unserialize(get_pref('smd_um_current_users', '', 1));
    $timeout = get_pref('smd_um_active_timeout', $smd_um_prefs['smd_um_active_timeout']['default']);
    $online = array();
    if (is_array($curr_users)) {
        foreach ($curr_users as $user => $last_access) {
            $still_active = strtotime("+$timeout seconds", $last_access);
            if ( ($still_active !== false) && ($still_active > time()) ) {
                $online[] = eLink($smd_um_event, '', 'search_method', 'login_name', $user, 'crit', $user);
            }
        }
    }

    return ($online) ? '<div class="smd_um_active_users">' . gTxt('smd_um_active') . join(', ', $online) . '</div>' : '';
}

// ------------------------
// Update any language string. Note this may leave orphan strings if the name is changed
function smd_um_upsert_lang($title, $name='') {
    global $textarray;

    $lang = get_pref('language', 'en-gb');
    $name = (isset($name) && $name != '') ? $name : strtolower(sanitizeForUrl($title));
    $table = 'txp_lang';
    $where = "name='" . doSlash($name) . "' AND lang='" . doSlash($lang) . "'";

    // Try to update first
    $ret = safe_update($table, "data='" . doSlash($title) . "'", $where);
    if ($ret && (mysql_affected_rows() || safe_count($table, $where))) {
        // Do nothing -- record has been updated
    } else {
        safe_insert($table, "event='admin', name='" . doSlash($name) . "', lang='" . doSlash($lang) . "', data='" . doSlash($title) . "'");
    }
    // Update the global array on the page so gtxt() can get it immediately
    $textarray[$name] = $title;
}

// ------------------------
function smd_um_get_groups($type=0) {
    global $txp_groups, $txp_user;
    static $permitted_users = array();

    if (isset($permitted_users[$type])) {
        return $permitted_users[$type];
    }

    $smd_um_prefs = smd_um_get_prefs();

    $levels = ($type) ? get_groups() : $txp_groups;
    $tiered = get_pref('smd_um_hierarchical_groups', $smd_um_prefs['smd_um_hierarchical_groups']['default']);
    $curr_priv = safe_field('privs', 'txp_users', "name = '" .doSlash($txp_user). "'");

    if (smd_um_table_exist(SMD_UM_GROUPS)) {
        $protected = get_pref('smd_um_admin_group', $smd_um_prefs['smd_um_admin_group']['default']);
        $grp = safe_rows('id, name', SMD_UM_GROUPS, '1=1');
        foreach ($grp as $row) {
            if ($protected && ($row['id'] == $protected) && ($curr_priv != $protected) ) {
                unset($levels[$row['id']]);
            } else {
                $levels[$row['id']] = (($type) ? gTxt($row['name']) : $row['name']);
            }
        }
    }

    if ($tiered) {
        // Remove any privs higher than the current logged in user
        foreach ($levels as $priv => $name) {
            if ( ($priv == 0) || ($priv >= $curr_priv) ) {
                $permitted_users[$type][$priv] = $name;
            }
        }
    } else {
        $permitted_users[$type] = $levels;
    }

    ksort($permitted_users[$type]);

    return $permitted_users[$type];
}

// ------------------------
function smd_um_multiedit_form($page, $sort, $dir, $crit, $search_method) {

    $levels = smd_um_get_groups(1);
    $privileges = selectInput('privs', $levels, '', '', '', 'privileges');

    $rs = safe_column('name', 'txp_users', '1=1');
    $assign_assets = $rs ? '<label for="assign_assets">'.gTxt('assign_assets_to').'</label>'.n.selectInput('assign_assets', $rs, '', true, '', 'assign_assets') : '';

    $methods = array(
        'changeprivilege' => array('label' => gTxt('changeprivilege'), 'html' => $privileges),
        'resetpassword'   => gTxt('resetpassword'),
        'delete'          => array('label' => gTxt('delete'), 'html' => $assign_assets),
    );

    if (safe_count('txp_users', '1=1') <= 1) unset($methods['delete']);

    return multi_edit($methods, 'smd_um', 'smd_um_multi_edit', $page, $sort, $dir, $crit, $search_method);
}

// ------------------------
// Cloned and tweaked from Admin tab :-(
function smd_um_multi_edit() {
    global $smd_um_event, $txp_user;

    require_privs($smd_um_event.'.usr.edit');

    $smd_um_prefs = smd_um_get_prefs();

    $selected = ps('selected');
    $method   = ps('edit_method');
    $changed  = array();

    if (!$selected or !is_array($selected))
    {
        return $smd_um_event();
    }

    $names = safe_column('name', 'txp_users', "name IN ('".join("','", doSlash($selected))."') AND name != '".doSlash($txp_user)."'");

    if (!$names) return $smd_um_event();

    switch ($method) {
        case 'delete':
            $assign_assets = ps('assign_assets');
            if ($assign_assets === '') {
                $msg = array('must_reassign_assets', E_ERROR);
            } elseif (in_array($assign_assets, $names)) {
                $msg = array('cannot_assign_assets_to_deletee', E_ERROR);
            } elseif (safe_delete('txp_users', "name IN ('".join("','", doSlash($names))."')")) {
                $changed = $names;
                $assign_assets = doSlash($assign_assets);
                $names = join("','", doSlash($names));

                // Delete private prefs
                safe_delete('txp_prefs', "user_name IN ('$names')");

                // Assign dangling assets to their new owner
                $reassign = array(
                    'textpattern' => 'AuthorID',
                    'txp_file'  => 'author',
                    'txp_image' => 'author',
                    'txp_link'  => 'author',
                );
                foreach ($reassign as $table => $col) {
                    safe_update($table, "$col='$assign_assets'", "$col IN ('$names')");
                }
                callback_event('authors_deleted', '', 0, $changed);
                $msg = 'author_deleted';
            }
            break;
        case 'changeprivilege':
            $levels = smd_um_get_groups(1);
            $privilege = ps('privs');

            if (!isset($levels[$privilege])) return $smd_um_event();

            if (safe_update('txp_users', 'privs = '.intval($privilege), "name IN ('".join("','", doSlash($names))."')")) {
                $changed = $names;
                $msg = 'author_updated';
            }
            break;

        case 'resetpassword':
            $failed  = array();
            $pass_len = get_pref('smd_um_pass_length', $smd_um_prefs['smd_um_pass_length']['default']);

            foreach ($names as $name) {
                $passwd = generate_password($pass_len);
                $hash = doSlash(txp_hash_password($passwd));

                if (safe_update('txp_users', "pass = '$hash'", "name = '".doSlash($name)."'")) {
                    $email = safe_field('email', 'txp_users', "name = '".doSlash($name)."'");

                    $cb_params = array(
                        'name'  => $name,
                        'email' => $email,
                        'pass'  => $passwd,
                    );

                    $msg = callback_event('smd_user_manager', 'password.reset', 0, $cb_params);
                    if (strlen($msg) === 0) {
                        if (send_new_password($passwd, $email, $name)) {
                            $changed[] = $name;
                            $msg = 'author_updated';
                        } else {
                            $msg = (array(gTxt('could_not_mail').' '.txpspecialchars($name), E_ERROR));
                        }
                    }
                }
            }
            break;
    }

    if ($changed) {
        return $smd_um_event(gTxt($msg, array('{name}' => txpspecialchars(join(', ', $changed)))));
    }

    $smd_um_event($msg);
}

// ------------------------
// Mostly cloned from Admin->Users tab
function smd_um_change_pass_form() {
    global $smd_um_event;

    pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_chp_lbl'), '');

    echo form(
        '<div class="txp-edit">'.
        hed(gTxt('change_password'), 2).n.
        inputLabel('new_pass', fInput('password', 'new_pass', '', '', '', '', INPUT_REGULAR, '', 'new_pass'), 'new_password').n.
        graf(checkbox('mail_password', '1', true, '', 'mail_password') .n. '<label for="mail_password">'.gTxt('mail_it').'</label>', ' class="edit-mail-password"').n.
        graf(fInput('submit', 'change_pass', gTxt('submit'), 'publish')).
        eInput($smd_um_event).
        sInput('smd_um_change_pass').
        '</div>'
    , '', '', 'post', '', '', 'change_password');
}

// ------------------------
// Mostly cloned from Admin->Users tab
function smd_um_change_pass() {
    global $event, $step, $txp_user;

    // Call the Admin side's change_pass routine so other plugins with a vested interest can join the party
    callback_event('admin', 'change_pass');

    extract(psa(array('new_pass', 'mail_password')));

    if (empty($new_pass)) {
        smd_um_dispatcher($event, '', array(gTxt('password_required'), E_ERROR));
        return;
    }

    $hash = doSlash(txp_hash_password($new_pass));
    $rs = safe_update('txp_users', "pass = '$hash'", "name = '".doSlash($txp_user)."'");

    if ($rs) {
        $msg = gTxt('password_changed');

        if ($mail_password) {
            $email = fetch('email', 'txp_users', 'name', $txp_user);
            send_new_password($new_pass, $email, $txp_user);
            $msg .= sp.gTxt('and_mailed_to').sp.$email;
        } else {
            echo comment(mysql_error());
        }

        $msg .= '.';
    } else {
        $msg = array(gTxt('smd_um_pass_change_error'), E_ERROR);
    }
    smd_um_dispatcher($event, '', $msg);
}

// ------------------------
function smd_um_save_pane_state() {
    global $smd_um_event;

    $pane = str_replace('smd_um_priv_', '', gps('pane'));
    $curr = do_list(get_pref('pane_smd_um_priv_visible'));
    $visible = gps('visible');
    if ($visible == 'true') {
        $curr[] = $pane;
    } else {
        $pos = array_search($pane, $curr);
        if ($pos !== false) {
            unset($curr[$pos]);
        }
    }

    $curr = array_unique($curr);

    set_pref("pane_smd_um_priv_visible", (join(',', $curr)), $smd_um_event, PREF_HIDDEN, 'text_input', 0, PREF_PRIVATE);
    send_xml_response();
}

// ****************
// TABLE MANAGEMENT
// ****************
// Add group/priv tables if not already installed
function smd_um_table_install($showpane='1') {
    global $smd_um_event, $txp_groups, $txp_permissions;

    $GLOBALS['txp_err_count'] = 0;
    $ret = '';
    $sql = array();

    // In truth, this table should be normalised further, but for the sake
    // of one row per priv level per area, it's quicker than a join, and
    // using GROUP_CONCAT() gets the priv table as in admin.config.php
    $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX.SMD_UM_PRIVS."` (
        `area` varchar(127) NOT NULL default '',
        `priv` smallint NOT NULL default 0,
        PRIMARY KEY (`area`,`priv`)
    ) ENGINE=MyISAM";

    // id is NOT an auto_increment colummn because autoinc doesn't allow a 0 entry, which we need for 'None'
    $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX.SMD_UM_GROUPS."` (
        `id` smallint(4) NOT NULL default 0,
        `name` varchar(64) NOT NULL default '',
        `core` bool NOT NULL default 0,
        PRIMARY KEY (`id`)
    ) ENGINE=MyISAM PACK_KEYS=1";

    // Handle upgrades: be kind to beta testers
    if (smd_um_table_exist(SMD_UM_PRIVS)) {
        $flds = getThings('SHOW COLUMNS FROM `'.PFX.SMD_UM_PRIVS.'`');
        if (in_array('core',$flds)) {
            $sql[] = "ALTER TABLE `".PFX.SMD_UM_PRIVS."` DROP `core`";
        }
    }

    // Append initial value population to query stack if this is a new install
    if (!smd_um_table_exist(SMD_UM_GROUPS)) {
        foreach ($txp_groups as $id => $name) {
            $sql[] = "INSERT INTO `".PFX.SMD_UM_GROUPS."` VALUES ('$id', '$name', 1)";
        }
    }
    if (!smd_um_table_exist(SMD_UM_PRIVS)) {
        foreach ($txp_permissions as $area => $privs) {
            $priv_list = do_list($privs);
            foreach ($priv_list as $priv) {
                $sql[] = "INSERT INTO `".PFX.SMD_UM_PRIVS."` VALUES ('$area', '$priv')";
            }
        }
    }

    if(gps('debug')) {
        dmp($sql);
    }
    foreach ($sql as $qry) {
        $ret = safe_query($qry);
        if ($ret===false) {
            $GLOBALS['txp_err_count']++;
            echo "<b>".$GLOBALS['txp_err_count'].".</b> ".mysql_error()."<br />\n";
            echo "<!--\n $qry \n-->\n";
        }
    }

    // Spit out results
    if ($GLOBALS['txp_err_count'] == 0) {
        if ($showpane) {
            $msg = gTxt('smd_um_tbl_installed');
            $smd_um_event($msg);
        }
    } else {
        if ($showpane) {
            $msg = gTxt('smd_um_tbl_not_installed');
            $smd_um_event($msg);
        }
    }
}

// ------------------------
// Drop table if in database
function smd_um_table_remove() {
    global $smd_um_event;

    $ret = '';
    $sql = array();
    $GLOBALS['txp_err_count'] = 0;
    if (smd_um_table_exist()) {
        $sql[] = "DROP TABLE IF EXISTS " .PFX.SMD_UM_PRIVS. "; ";
        $sql[] = "DROP TABLE IF EXISTS " .PFX.SMD_UM_GROUPS. "; ";
        if(gps('debug')) {
            dmp($sql);
        }
        foreach ($sql as $qry) {
            $ret = safe_query($qry);
            if ($ret===false) {
                $GLOBALS['txp_err_count']++;
                echo "<b>".$GLOBALS['txp_err_count'].".</b> ".mysql_error()."<br />\n";
                echo "<!--\n $qry \n-->\n";
            }
        }
    }
    if ($GLOBALS['txp_err_count'] == 0) {
        $msg = gTxt('smd_um_tbl_removed');
    } else {
        $msg = gTxt('smd_um_tbl_not_removed');
        $smd_um_event($msg);
    }
}

// ------------------------
function smd_um_table_exist($which='') {
    static $smd_um_installed = array();

    // The number of expected cols in each table
    $tbls = array(
        SMD_UM_GROUPS => 3,
        SMD_UM_PRIVS => 2,
    );

    if ($which && array_key_exists($which, $tbls) && isset($smd_um_installed[$which])) {
        return ($smd_um_installed[$which] == $tbls[$which]);
    }

    if ($which == '1') {
        $out = count($tbls);
        foreach ($tbls as $tbl => $cols) {
            $num = count(@safe_show('columns', $tbl));
            $smd_um_installed[$tbl] = $num;
            $out -= ($tbls[$tbl] == $num) ? 1 : 0;
        }
        return ($out===0) ? 1 : 0;
    } else if (array_key_exists($which, $tbls)) {
        $num = count(@safe_show('columns', $which));
        $smd_um_installed[$which] = $num;
        return ($smd_um_installed[$which] == $tbls[$which]);
    }

    return false;
}


//*****************
// PUBLIC SIDE TAGS
// Though we could load all $txp_permissions / $txp_groups to the public side for speed,
// exposing permissions to the world is not such a hot idea. Therefore the privs are
// fetched ad-hoc and cached
function smd_um_has_privs($atts, $thing=NULL) {
    global $txp_user;
    static $smd_um_permissions;
    static $smd_um_groups;
    static $smd_ili = 0;

    extract(lAtts(array(
        'name'  => '',
        'group' => '',
        'area'  => '',
        'debug' => 0,
    ),$atts));

    $ret = false;
    $smd_ili = ($smd_ili === 0) ? is_logged_in() : $smd_ili;

    if ($smd_ili) {
        $names = do_list($name);
        $groups = do_list($group);
        $areas = do_list($area);

        // Handle > and < groups
        $grplist = array();
        foreach ($groups as $grp) {
            if ( (strpos($grp, '>') === 0) || (strpos($grp, '<') === 0) ) {
                if (!isset($smd_um_groups)) {
                    $smd_um_groups = safe_column('id', SMD_UM_GROUPS, '1=1 ORDER BY id');
                }
                $val = substr($grp, 1);
                // Pull out all groups higher than this one
                if (substr($grp, 0, 1) == '>') {
                    foreach($smd_um_groups as $ug) {
                        if ($ug > $val) $grplist[] = $ug;
                    }
                }
                // Pull out all groups lower than this one
                if (substr($grp, 0, 1) == '<') {
                    foreach($smd_um_groups as $ug) {
                        if (($ug < $val) && ($ug != '0')) $grplist[] = $ug;
                    }
                }
            } else {
                $grplist[] = $grp;
            }
        }
        $groups = array_unique($grplist);

        if ($debug) {
            echo '++ LOGGED IN CREDENTIALS / PERMISSION AREAS / ALL GROUP IDs / NAME ATTR / GROUP ATTR / AREA ATTR ++';
            dmp($smd_ili, $smd_um_permissions, $smd_um_groups, $names, $groups, $areas);
        }

        $isname  = ($name && in_array($smd_ili['name'], $names));
        $isgroup = (($group != '') && in_array($smd_ili['privs'], $groups));
        $isarea = false;

        // Build up a cached array of privs by area
        if ($areas) {
            // TODO: would be nice to do this in one query somehow
            foreach ($areas as $place) {
                if (!isset($smd_um_permissions[$place])) {
                    $prv = safe_field('GROUP_CONCAT(priv) AS privs', SMD_UM_PRIVS, "area = '" . doSlash($place) . "'");
                    $smd_um_permissions[$place] = $prv;
                }
                $isarea = ( $isarea || (in_array($smd_ili['privs'], do_list($smd_um_permissions[$place]))) );
            }
        }

        if ($debug) {
            echo '++ TEST AGAINST NAME / GROUP / AREA ++';
            dmp($isname, $isgroup, $isarea);
        }

        // Compare the current logged in credentials against the relevant passed-in attribute combinations
        if ($name) {
            if ($group) {
                if ($area) {
                    if ($debug) dmp('CHECK NAME AND GROUP AND AREA');
                    $ret = ($isname && $isgroup && $isarea);
                } else {
                    if ($debug) dmp('CHECK NAME AND GROUP');
                    $ret = ($isname && $isgroup);
                }
            } else if ($area) {
                if ($debug) dmp('CHECK NAME AND AREA');
                $ret = ($isname && $isarea);
            } else {
                if ($debug) dmp('CHECK NAME');
                $ret = $isname;
            }
        } elseif($group) {
            if ($area) {
                if ($debug) dmp('CHECK GROUP AND AREA');
                $ret = ($isgroup && $isarea);
            } else {
                if ($debug) dmp('CHECK GROUP');
                $ret = $isgroup;
            }
        } elseif($area) {
            if ($debug) dmp('CHECK AREA');
            $ret = $isarea;
        } else {
            if ($debug) dmp('NO CHECKS (ANY USER)');
            $ret = true;
        }
    }

    return parse(EvalElse($thing, $ret));
}

// ------------------------
// Settings for the plugin
function smd_um_get_prefs() {
    global $prefs;

    $smd_um_prefs = array(
        'smd_um_hierarchical_groups' => array(
            'html'     => 'yesnoradio',
            'type'     => PREF_HIDDEN,
            'position' => 10,
            'default'  => '0',
            'group'    => 'smd_um_settings',
        ),
        'smd_um_admin_group' => array(
            'html'     => 'selectlist',
            'type'     => PREF_HIDDEN,
            'position' => 20,
            'content'  => array(get_groups(), false),
            'default'  => '1',
            'group'    => 'smd_um_settings',
        ),
        'smd_um_max_search_limit' => array(
            'html'     => 'text_input',
            'type'     => PREF_HIDDEN,
            'position' => 30,
            'default'  => '500',
            'group'    => 'smd_um_settings',
        ),
        'smd_um_pass_length' => array(
            'html'     => 'text_input',
            'type'     => PREF_HIDDEN,
            'position' => 40,
            'default'  => '12',
            'group'    => 'smd_um_settings',
        ),
        'smd_um_active_timeout' => array(
            'html'     => 'text_input',
            'type'     => PREF_HIDDEN,
            'position' => 50,
            'default'  => '60',
            'group'    => 'smd_um_settings',
        ),
        'smd_um_self_alter' => array(
            'html'     => 'yesnoradio',
            'type'     => PREF_HIDDEN,
            'position' => 60,
            'default'  => '0',
            'group'    => 'smd_um_settings',
        ),
    );

    return $smd_um_prefs;
}
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
h1. smd_user_manager

Complete user / group / privs management. Features:

* Replaces _Admin->Users_ tab
* Add / edit / list users, with content counts alongside each user
* Search, sort, or filter the users (standard Txp pagination result depths apply)
* Quickly find accounts with certain characteristics (e.g. self-registered spam accounts with 0 articles)
* Perform multi-edits: change privilege / reset pass / delete
* All users can edit their own details and change their password
* Create new user groups (a.k.a. roles) if the default six aren't enough
* Rename existing groups to more suitable names (you cannot delete them)
* Modify Txp's standard priv areas to alter what each user group can see/do
* Add new priv areas (useful for custom code to save doing it in a plugin)
* A "who's online" indicator
* Integrates with smd_bio (v0.40+) and smd_prognostics (v0.20+)

h2. Installation / uninstallation

p(important). Requires Txp 4.5.0+

Download the plugin from either "textpattern.org":http://textpattern.org/plugins/1229/smd_user_manager, or the "software page":http://stefdawson.com/sw, paste the code into the Txp _Admin->Plugins_ pane, install and enable the plugin. The tables will be installed and populated automatically unless you use the plugin from the cache directory; in either case, visiting the _Admin->User manager_ tab will install and populate them.

To uninstall the plugin, first assign all your users to groups in Txp's first six, then delete the plugin from the _Admin->Plugins_ page. The tables will be deleted automatically. If you do not reassign users to those default groups, you may have users with 'dangling' (i.e. no) privs. The outcome of what happens when such users log in is thus undefined: at the very least you'll get admin-side errors thrown.

Visit the "forum thread":http://forum.textpattern.com/viewtopic.php?id=36558 for more info or to report on the success or otherwise of the plugin.

h2. Admin side overview

Visit the _Admin->User manager_ tab. The default view (for admins) is a list of users. There are buttons at the top of the screen: __Change password__, "Users":#smd_um_users, "Groups":#smd_um_groups, "Privs":#smd_um_privs, and "Prefs":#smd_um_prefs. Each of those displays an area for the management of that component.

Please note: The plugin tries to remove the _Admin->Users_ menu, but depending on your installed theme this may not be possible. If the menu item remains, it will perform the same function as clicking the _User manager_ tab.

h2(#smd_um_users). User management (_Users_ button)

View / search the installed user base. Change the number of users you wish to see per page by using the 'per page' dropdown below the list. The columns on display are:

* Login -- user name
* Real Name -- full name
* E-mail -- e-mail address
* Privileges -- user group
* Last Login -- month & year of last access to the Textpattern admin side
* Articles -- number of articles authored by this user
* Images -- number of images uploaded by this user
* Files -- number of files uploaded by this user
* Links -- number of links created by this user

Click _New user_ (admins only) to create a new user account and automatically send a randomly-generated password to the nominated e-mail address.
Click a login name (privileges required) to edit the details about that user. If you have any smd_bio fields set up, they can also be edited (and hovering over the login name will retrieve some extended biographical info).
Click an e-mail address to launch your e-mail software to send a message to the user.
Click an article / image / file / link value to see the content owned by that user.

You may sort the columns by clicking the headings. Click once to sort in ascending order, click again to sort in descending order. An arrow shows the sort direction. Your sort column and direction are remembered next time you visit the panel.

You may also search users by login name, real name, e-mail address, privilege level (number or name), or content count. A few notes about searching:

* When searching privileges by name, only the _first matching_ group will be returned -- the privs are searched in order of their ID.
* You may search privileges and content counts by specifying an exact value, for example Article count: 0 shows all accounts with no articles (perhaps a self-registered spammer or malicious user?)
* You may also search these fields using greater-than or less-than symbols to find users with the matching number of assets. For example, Image count: @>=50@ shows all users with 50 images or more.

You can also perform multi-edits by selecting the rows to alter via the checkboxes and using the dropdown immediately below the list to make mass changes. The options are:

* Change privileges: set all selected users to the given privilege level. When you choose this option, a further dropdown appears to allow you to choose which level to apply.
* Reset password: send a new password to all selected users.
* Delete: remove all selected user accounts. A further dropdown appears with a list of user accounts in it: choose one to transfer over any content that belonged to the deleted user(s).

A common use is to find any users with 0 articles, and then use the multi-edit tool to delete them all.

h2(#smd_um_groups). Group management (_Groups_ button)

This panel allows you to alter the names of Txp's built-in 6 groups to suit your application. It changes the Titles in the currently installed language only.

You may also add a new group using the input controls and accompanying _Create_ button at the top of the panel. If you choose to only enter a Title, a name will be automatically generated (lower case, with most non-ASCII characters replaced by safe characters). Alternatively, you can type your own name, though please stick to 'simple' letters and numbers to make things easy on yourself later. If you choose an existing group from the _based on_ dropdown, the privs for that group will be copied across to your new group.

Custom groups can be deleted using the 'x' button alongside each. Any users that were assigned to that group will have their privileges reduced to 'None'. Either visit the _Users_ panel and alter their priv level to something suitable, or set their level to something else prior to deleting the group.

If any group contains at least one user, the group ID values are hyperlinked back to the Users panel to show only those users in that group. This is handy for reassigning priv levels before deleting a group. If you hover over the priv ID, a tooltip will display the number of users assigned to that privilege group.

h2(#smd_um_privs). Priv management (_Privs_ button)

From this panel you may alter which user groups can access which parts of the admin side interface or perform certain types of action. You will see a list of 'area' headings. Click one to expand it and see the privileges it contains; click it again to collapse it. The open/closed state of the areas is remembered next time you visit the panel.

Each area has a row of checkboxes alongside it. If a checkbox is ticked in a column corresponding to a privilege group, that group has access to that feature of the interface. You may alter who sees what by changing the tick boxes and hitting one of the _Save_ buttons that appear to the left of each area heading; all the buttons do the same thing: they save the entire list of privileges. You must confirm the action, because the change is immediate.

You may change checkboxes in batches by selecting rows/columns and then using a keyboard shortcut to make changes to all highlighted checkboxes. Firstly, choose which checkboxes to apply your changes:

# click a column heading to highlight that entire Group
# click a row heading to highlight that entire Priv set
# click the top left-hand corner of the collapsible table to select all checkboxes

You can select multiple columns/rows from multiple areas if you wish. Clicking a row/column/corner heading again will toggle its status.

When you are ready to make changes to the selected checkboxes, you can use the following keys:

* @c@ to check all selected boxes
* @u@ to uncheck all selected boxes
* @t@ to toggle the status of all selected boxes (checked become unchecked, and vice versa)
* @d@ deselects all rows / columns you have highlighted

The area headings merely group the areas for convenience and make the page look less scary! Any plugins you have installed will be shown under an area heading of the author's three-letter prefix. Note that altering privs here overrides the privs as set by the plugin so you can customise who sees what, _as long as the plugin in question is loaded before smd_user_manager_. Check the plugin load order values if things aren't working as you expect.

The 'tab' area heading governs which user groups have access to the primary navigation areas (content, presentation, admin, extensions and any custom tabs such as those created by smd_tabber). Note that giving access to these tabs does not automatically give access to the secondary navigation elements; you must turn those on independently. By contrast, giving a user group access to a secondary navigation item _does_ allow them to use that feature but they won't be able to navigate to it using the primary navigation button unless they have also been given access to that tab.

For example, if you grant the 'page' privilege to Freelancers but don't give them access to the Presentation tab, they could type @?event=page@ in the URL to get to the Pages panel but they would have no means of navigating there by clicking the mouse. Since the primary 'Presentation' tab is missing, the secondary tabs are all missing too, even though some of them may be permitted for that group of users.

If you wish to add your own priv area, type a new one in the box at the top of the panel and hit _Create_. Your area will be created under the appropriate heading, e.g. if you specified @smd_test@ it would appear under the @smd@ heading, or if you created a @file.trusted@ privilege area, it would appear under the @file@ heading. Core areas are normally specified by a dotted notation but you are free to choose any notation that makes sense to your application.

Note that:

# some plugins may not show up in the list due to factors such as plugin load order or the mechanism by which the plugin is written.
# the @[R]@ column is a special Reset indicator. Checking any row in this column will ignore any privilege checkboxes you may have set or altered and will reset the corresponding privs to their defaults after you click Save.
# by default you may not add @smd_um@ privs to override the functionality if this plugin, although you can adjust who can edit what so be careful not to open the permissions too widely. A preference setting governs whether smd_um can have its own privs altered.
# you can create priv areas that may be tested from the public side using the "smd_um_has_privs":#smd_um_has_privs tag.

h2(#smd_um_prefs). Preference management (_Prefs_ button)

Administrators can set global preferences that govern the behaviour of the plugin:

; *Assume hierarchical groups*
: Textpattern does not normally have the notion of escalating privilege levels. A Copy Editor is not _greater than_ a Staff Writer, for example, they just have different permissions to fulfil the relevant role.
: You may set this preference to _yes_ to force Textpattern to treat your levels as a hierarchy, i.e. lower numbers are "more powerful" than higher numbers (with the exception of 0: None which is always 'no privs').
: Once set, logged-in users may not create or edit any other users that are 'above' their assigned privs, e.g. Copy Editors cannot modify Publisher or Managing Editor accounts. Further, it is not possible to alter your own privileges, nor can you create a user with a greater priv level than you possess.
: Default: no
; *Protected administrator group*
: Nominate a group that you wish only administrators to be able to alter/create.
: Once set, the nominated group is off-limits to all users apart from those already in the selected group. In other words, non-admin users cannot create, modify, alter (or mass-alter) any privilege setting using this group.
: Can be used in tandem with or independently of the _Assume hierarchical groups_ setting.
: Default: 1 (a.k.a. Publishers)
; *Maximum user search result limit*
: Maximum number of search results to return when filtering the User list.
: Default: 500
; *Password length (characters)*
: The number of characters in newly-generated passwords. The higher the better (up to a point).
: Default: 12
; *Activity timeout (seconds)*
: Number of seconds within which someone has to perform an admin-side action to remain visible on the Active Users list. For high activity sites, you can lower this value and receive a more responsive (accurate) list, at the possible expense of more perceived fluctuations in user activity when the timeout is exceeded. Lengthening the value will keep online users in the list longer, even though they may not actually still be active.
: Default: 60
; *Allow smd_um privs to be altered*
: Set this to _yes_ to allow smd_um privs to be changed from the Privs panel.
: Default: no

h2(#smd_um_non_admin). Non-admin users

User accounts without privileges to list users will automatically be shown the Edit screen for their own user account. This is the only account that can be edited. If smd_bio is installed, additional biographical information may also be edited.

Users may also change their password using the button at the top of the screen.

h2(#smd_um_active). Active users

At the bottom of each smd_user_manager panel is a list of currently active ("online") users. Each user is hyperlinked to the "Users":#smd_um_users panel to show you the info about just that person, which is a convenient shortcut to find out about a logged-in author.

An active user is one who has performed some admin-side action in the past N seconds, where N is defined in the "Activity Timeout plugin preference":#smd_um_prefs.

h2(#smd_um_callbacks). Developer callbacks

The plugin honours as many existing Textpattern callbacks found on the __Admin->Users__ panel as it can. In addition, the following callbacks are defined:

table(txp-list).
|_. Event |_. Step |_. Pre |_. Payload |_. Comments |
| smd_user_manager | password.reset | 0 | array comprising user name, password and email address | Return some string from your callback function to bypass the internal send_new_password() call. The returned string will be announced in the UI. Returning an empty string (or null) will still trigger the default password reset behaviour |

h2. Public side tags

h3(#smd_um_has_privs). Tag: @<txp:smd_um_has_privs>@

Use this conditional tag to check if the currently logged-in user has permissions to perform some action. If they have, the contained content is executed. Supports @<txp:else />@.

Note that the plugin does not have a public-side logging in/out facility, it merely allows you to test whether someone who has logged in via the admin side (or via a third party login plugin) has necessary privileges.

Attributes:

; %name%
: Check the current logged-in user's name against this list of names.
: IMPORTANT: Case sensitive.
; %group%
: Check the current logged-in user's group (privilege) level is in this list of numbers.
: You can specify @>@ and @<@ symbols before any value to indicate you wish to check if the user has privileges higher or lower than a given number, respectively.
: If checking priv values less than a number, 0 (a.k.a None) is _never_ included: you must add it to the list explicitly if you wish to test for it.
: Example: @group="11, <4"@ means "does the user have privs of 11, 1, 2, or 3?"
; %area%
: Check the current logged-in user has the ability to access one of the given areas in this list.
: Example: @area="sports_hall, chemistry_lab"@ would only perform the contained content if the logged-in user's priv level was present in either the sports_hall or chemistry_lab priv areas.

Notes:

* You can combine the attributes in any way: the contained content will only be executed if the logged-in user matches *all* the criteria.
* Without any attributes, the contained content will be executed if anybody is logged in, regardless of their name, privs or assigned areas.
* Again: login @name@s are case sensitive

h2. Author / credits

Written by "Stef Dawson":http://stefdawson.com/contact. Thanks to the beta test team jakob, mrdale, alanfluff, maverick, Destry, redbot, and rsilletti for their willingness to let my code loose on their servers.

h2. Changelog

* 10 Nov 2013 | v0.21 | Only save privs if they differ
* 16 May 2013 | v0.20 | Updated for Txp 4.5.0+; added callback smd_user_manager > password.reset to allow interception of reset messages (thanks MattE)
* 25 Jan 2012 | v0.12 | Fixed smd_um_has_privs multiple area check ; fixed prefs options from Plugins pane
* 03 Nov 2011 | v0.11 | Added smd_um_has_privs tag to check privs/areas ; added preference to allow editing of smd_um privs; fixed handling of users with privs=None
* 27 Jul 2011 | v0.10 | Initial public release
# --- END PLUGIN HELP ---
-->
<?php
}
?>

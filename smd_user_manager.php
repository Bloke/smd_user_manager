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

$plugin['version'] = '0.4.0';
$plugin['author'] = 'Stef Dawson';
$plugin['author_uri'] = 'https://stefdawson.com/';
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
#@owner smd_user_manager
#@language en, en-gb, en-us
#@admin-side
smd_um_active => Currently active: {users}
#@admin
smd_um_article_count => Articles
smd_um_based_on => based on
smd_um_file_count => Files
smd_um_grp_affected => . Users affected: {num}
smd_um_grp_created => Group "{name}" created
smd_um_grp_deleted => Group deleted
smd_um_grp_exists => Group already exists as priv ID {id}
smd_um_grp_lbl => Groups
smd_um_grp_new => New group title
smd_um_grp_new_name => name
smd_um_grp_not_deleted => Core groups cannot be deleted
smd_um_grp_saved => Group info updated
smd_um_heading_grp => User groups
smd_um_heading_prf => User manager settings
smd_um_heading_prv => User privileges
smd_um_image_count => Images
smd_um_link_count => Links
smd_um_name_required => A name is required
smd_um_prf_lbl => Prefs
smd_um_prv_created => Priv area "{area}" created
smd_um_prv_exists => Priv area already exist
smd_um_prv_lbl => Privs
smd_um_prv_new => New priv area
smd_um_prv_saved => Privs updated
smd_um_prv_smd_um => Cannot create privs for smd_user_manager
smd_um_reset => [R]
smd_um_sel_all => Select the entire area then (c)heck, (u)ncheck or (t)oggle highlighted checkboxes
smd_um_sel_grp => Select this group then (c)heck, (u)ncheck or (t)oggle highlighted checkboxes
smd_um_sel_prv => Select this area set then (c)heck, (u)ncheck or (t)oggle highlighted checkboxes
smd_um_sel_reset => Reset: any checked area sets will revert to their defaults after Save
smd_um_settings => Settings
smd_um_tbl_installed => Tables installed
smd_um_tbl_not_installed => Tables not installed
smd_um_tbl_not_removed => Tables not removed
smd_um_tbl_removed => Tables removed
smd_um_user_count => Users in this group: 
smd_um_usr_lbl => Users
#@prefs
smd_user_manager => User manager
smd_um_active_timeout => Activity timeout (seconds)
smd_um_admin_group => Protected administrator group
smd_um_hierarchical_groups => Assume hierarchical groups (levels)
smd_um_self_alter => Allow smd_um privs to be altered
#@language fr
#@admin-side
smd_um_active => Utilisateurs actuellement actifs {users}
#@admin
smd_um_article_count => Articles
smd_um_based_on => basé sur
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
smd_um_image_count => Images
smd_um_link_count => Liens
smd_um_name_required => Un nom est requis
smd_um_prf_lbl => Préférences
smd_um_prv_created => Définition de privilèges "{area}" créée
smd_um_prv_exists => Cette définition de privilèges existe déjà
smd_um_prv_lbl => Privilèges
smd_um_prv_new => Nouvelle définition de privilège
smd_um_prv_saved => Privilèges mis à jour
smd_um_prv_smd_um => Impossible de créer les privilèges pour smd_user_manager
smd_um_reset => [R]
smd_um_sel_all => Sélectionnez la zone entière puis cocher (c), décocher (u) ou basculer les cases en surbrillance (t)
smd_um_sel_grp => Sélectionnez le groupe puis cocher (c), décocher (u) ou basculer les cases en surbrillance (t)
smd_um_sel_prv => Sélectionnez la zone puis cocher (c), décocher (u) ou basculer les cases en surbrillance (t)
smd_um_sel_reset => Réinitialiser : toutes les sélections verront leurs réglages rétablis par défaut après enregistrement
smd_um_settings => Paramètres
smd_um_tbl_installed => Tables installées
smd_um_tbl_not_installed => Tables non installées
smd_um_tbl_not_removed => Tables non supprimées
smd_um_tbl_removed => Tables supprimées
smd_um_user_count => Utilisateurs de ce groupe :&nbsp;
smd_um_usr_lbl => Utilisateurs
#@prefs
smd_um_active_timeout => Durée d'activité (secondes)
smd_um_admin_group => Groupe protégé d'administrateurs
smd_um_hierarchical_groups => Chargé de la hiérarchie des groupes (levels)
smd_um_self_alter => Accès aux privilèges de smd_um
#@language es
#@admin-side
smd_um_active => Usuarios actualmente conectados: {users}
#@admin
smd_um_article_count => Artículos
smd_um_based_on => basado en
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
smd_um_image_count => Imágenes
smd_um_link_count => Enlaces
smd_um_name_required => Se requiere un nombre
smd_um_prf_lbl => Preferencias
smd_um_prv_created => Área de privilegios "{area}" creada
smd_um_prv_exists => Área de privilegios ya existe
smd_um_prv_lbl => Privilegios
smd_um_prv_new => Nuevo área de privilegios
smd_um_prv_saved => Privilegios actualizados
smd_um_prv_smd_um => Imposible crear privilegios para smd_user_manager
smd_um_reset => [R]
smd_um_sel_all => Selecciona esta área completa, luego marca (c), desmarca (u) o invierte (t) la selección
smd_um_sel_grp => Selecciona este grupo, luego marca (c), desmarca (u) o invierte (t) la selección
smd_um_sel_prv => Selecciona este área, luego marca (c), desmarca (u) o invierte (t) la selección
smd_um_sel_reset => Reajustar: todas las áreas marcadas volverán a sus valores por defecto después de guardar
smd_um_settings => Preferencias
smd_um_tbl_installed => Tablas instaladas
smd_um_tbl_not_installed => Tablas no instaladas
smd_um_tbl_not_removed => Tablas no eliminadas
smd_um_tbl_removed => Tablas eliminadas
smd_um_user_count => Usuarios en este grupo:
smd_um_usr_lbl => Usuarios
#@prefs
smd_um_active_timeout => Desconectar a los usuarios después de (segundos)
smd_um_admin_group => Grupo protegido de administradores
smd_um_hierarchical_groups => Asumir grupos jerárquicos (niveles)
smd_um_self_alter => Permitir cambiar privilegios a smd_um
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
 * @link   https://stefdawson.com/
 */
// TODO:
//  -> Why does multi-edit fire twice? Is it still attached to the Admin->Users table?

use \Textpattern\Search\Filter;

new smd_um();

if (class_exists('\Textpattern\Tag\Registry')) {
    Txp::get('\Textpattern\Tag\Registry')
        ->register('smd_um_has_privs');
}

/**
 * Public tag: Conditionally check privs and take action.
 *
 * Though we could load all $txp_permissions / $txp_groups to the public side for speed,
 * exposing permissions to the world is not such a hot idea. Therefore the privs are
 * fetched ad-hoc and cached.
 *
 * @param array  $atts  Tag attributes
 * @param string $thing Tag container content
 */
function smd_um_has_privs($atts, $thing = null)
{
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

        // Handle > and < groups.
        $grplist = array();

        foreach ($groups as $grp) {
            if ((strpos($grp, '>') === 0) || (strpos($grp, '<') === 0)) {
                if (!isset($smd_um_groups)) {
                    $smd_um_groups = safe_column('id', 'smd_um_groups', '1=1 ORDER BY id');
                }

                $val = substr($grp, 1);

                // Pull out all groups higher than this one.
                if (substr($grp, 0, 1) === '>') {
                    foreach ($smd_um_groups as $ug) {
                        if ($ug > $val) $grplist[] = $ug;
                    }
                }

                // Pull out all groups lower than this one.
                if (substr($grp, 0, 1) === '<') {
                    foreach ($smd_um_groups as $ug) {
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

        $isname = ($name && in_array($smd_ili['name'], $names));
        $isgroup = (($group != '') && in_array($smd_ili['privs'], $groups));
        $isarea = false;

        // Build up a cached array of privs by area.
        if ($areas) {
            // TODO: would be nice to do this in one query somehow
            foreach ($areas as $place) {
                if (!isset($smd_um_permissions[$place])) {
                    $prv = safe_field('GROUP_CONCAT(priv) AS privs', 'smd_um_privs', "area = '" . doSlash($place) . "'");
                    $smd_um_permissions[$place] = $prv;
                }

                $isarea = ($isarea || (in_array($smd_ili['privs'], do_list($smd_um_permissions[$place]))));
            }
        }

        if ($debug) {
            echo '++ TEST AGAINST NAME / GROUP / AREA ++';
            dmp($isname, $isgroup, $isarea);
        }

        // Compare the current logged in credentials against the relevant passed-in attribute combinations.
        if ($name) {
            if ($group) {
                if ($area) {
                    $debug && dmp('CHECK NAME AND GROUP AND AREA');
                    $ret = ($isname && $isgroup && $isarea);
                } else {
                    $debug && dmp('CHECK NAME AND GROUP');
                    $ret = ($isname && $isgroup);
                }
            } elseif ($area) {
                $debug && dmp('CHECK NAME AND AREA');
                $ret = ($isname && $isarea);
            } else {
                $debug && dmp('CHECK NAME');
                $ret = $isname;
            }
        } elseif ($group) {
            if ($area) {
                $debug && dmp('CHECK GROUP AND AREA');
                $ret = ($isgroup && $isarea);
            } else {
                $debug && dmp('CHECK GROUP');
                $ret = $isgroup;
            }
        } elseif ($area) {
            $debug && dmp('CHECK AREA');
            $ret = $isarea;
        } else {
            $debug && dmp('NO CHECKS (ANY USER)');
            $ret = true;
        }
    }

    return parse($thing, $ret);
}

/**
 * User manager admin interface.
 */
class smd_um
{
    /**
     * The plugin's event as registered in Txp.
     *
     * @var string
     */
    protected $event = 'admin';

    /**
     * The plugin's version.
     *
     * @var string
     */
    protected $version = '0.4.0';

    /**
     * The plugin's privileges.
     *
     * @var string
     */
    protected $privs = '1';

    /**
     * Any UI message to announce.
     *
     * @var string
     */
    protected $message = '';

    /**
     * Constructor to set up callbacks and environment.
     *
     * Access is also logged so we know who's logged in and active.
     */
    public function __construct()
    {
        global $event, $txp_user, $step;

        if (txpinterface === 'admin') {
            if ($event === 'prefs') {
                add_privs('prefs.smd_user_manager', $this->privs);
            } elseif ($event === 'plugin_prefs.smd_user_manager') {
                add_privs('plugin_prefs.smd_user_manager', $this->privs);
            } elseif ($event === $this->event) {
                add_privs($this->event.'.smd_um_grp', $this->privs);
                add_privs($this->event.'.smd_um_prv', $this->privs);
                register_callback(array($this, 'steps'), 'user', 'steps');
                register_callback(array($this, 'buttons'), 'user', 'controls', 'panel');
                register_callback(array($this, 'groups'), 'admin', 'smd_um_groups', 1);
                register_callback(array($this, 'group_add'), 'admin', 'smd_um_group_add', 1);
                register_callback(array($this, 'group_del'), 'admin', 'smd_um_group_del', 1);
                register_callback(array($this, 'group_save'), 'admin', 'smd_um_group_save', 1);
                register_callback(array($this, 'privs'), 'admin', 'smd_um_privs', 1);
                register_callback(array($this, 'priv_add'), 'admin', 'smd_um_priv_add', 1);
                register_callback(array($this, 'priv_save'), 'admin', 'smd_um_priv_save', 1);
            }

            add_privs($this->event.'.smd_um_active', $this->privs);
            register_callback(array($this, 'welcome'), 'plugin_lifecycle.smd_user_manager');
            register_callback(array($this, 'options'), 'plugin_prefs.smd_user_manager', null, 1);
            register_callback(array($this, 'inject_css'), 'admin_side', 'head_end');
            $has_footer = callback_handlers('admin_side', 'footer');

            if (has_privs($this->event.'.smd_um_active') && !in_array(__CLASS__.'->active_users', $has_footer)) {
                register_callback(array($this, 'active_users'), 'admin_side', 'footer');
            }
        }

        // Call the installer in case the lifecycle event didn't fire.
        $this->install();

        // Log the time of this access attempt.
        $curr_users = json_decode(get_pref('smd_um_current_users', ''), true);

        if (!$curr_users) {
            $curr_users = array();
        }

        $curr_users[$txp_user] = time();
        set_pref('smd_um_current_users', json_encode($curr_users), 'smd_um', PREF_HIDDEN, '', 0);

        // Merge in the groups only for now.
        $this->priv_merge(true, false);

        // Permit user self-editing.
        $smd_um_grps = array_keys($this->get_groups(0));

        // Remove None user.
        unset($smd_um_grps[0]);

        // Now the privs are established for all admin steps so we can go ahead
        // and merge in the changes. One caveat: if we're saving the privs we
        // need to delay the database merge until after the resets have been applied,
        // otherwise we won't know what the defaults (in admin_config.php) are.
        $do_privs = ($step === 'smd_um_priv_save') ? false : true;
        $this->priv_merge(false, $do_privs);
    }

    /**
     * CSS definitions: hopefully kind to themers.
     *
     * @return string Style rules
     */
    protected function get_style_rules()
    {
        $smd_um_styles = array(
            'control-panel' => '
.smd_um_privgroup { position:relative; }
.smd_um_privgroup h3 { text-align:left; font-weight:bold; }
.smd_um_privsave { position:absolute; left:25px; top:2rem; }
.smd_um_selected { background-color:#e2dfce; }
.smd_um_grp_name, .smd_um_prv_name, .smd_um_reset_col { cursor:pointer; }
.smd_um_checkbox, .smd_um_prv_hdr { text-align:center!important; }
',
        );

        return $smd_um_styles;
    }

    /**
     * Inject style rules into the &lt;head&gt; of the page.
     *
     * @param  string $evt Textpattern event (panel)
     * @param  string $stp Textpattern step (action)
     * @return string      Style rules, or nothing if not the correct $event
     */
    public function inject_css($evt, $stp)
    {
        global $event;

        if ($event === $this->event || $event === 'admin') {
            $smd_um_styles = $this->get_style_rules();

            if (class_exists('\Textpattern\UI\Style')) {
                echo Txp::get('\Textpattern\UI\Style')->setContent($smd_um_styles['control-panel']);
            } else {
                echo '<style>' . $smd_um_styles['control-panel'] . '</style>';
            }
        }

        return;
    }

    /**
     * Register the plugin's steps with the core panel.
     *
     * @param  string $evt           Textpattern event (panel)
     * @param  string $stp           Textpattern step (action)
     * @param  array  &$plugin_steps Current set of steps to be modified
     */
    public function steps($evt, $stp, &$plugin_steps)
    {
        if (has_privs('admin.edit')) {
            $plugin_steps += array(
                'smd_um_groups'     => false,
                'smd_um_group_add'  => true,
                'smd_um_group_del'  => true,
                'smd_um_group_save' => true,
                'smd_um_privs'      => false,
                'smd_um_priv_add'   => true,
                'smd_um_priv_save'  => true,
            );
        }
    }

    /**
     * Lifecycle handling, post-install / delete.
     *
     * @param  string $evt Textpattern event (panel)
     * @param  string $stp Textpattern step (action)
     * @return string      Success/failure message
     */
    public function welcome($evt, $stp)
    {
        $msg = '';

        switch ($stp) {
            case 'installed':
                $this->install();
                $msg = 'Super duper users!';
                break;
            case 'deleted':
                $this->remove();
                break;
        }

        return $msg;
    }


    /**
     * Add a new user group.
     *
     * @param  string $evt  Textpattern event (panel)
     * @param  string $stp  Textpattern step (action)
     */
    public function group_add($evt, $stp)
    {
        global $txp_permissions;

        require_privs($this->event.'.smd_um_grp');

        $title = ps('smd_um_new_grp');
        $name = ps('smd_um_new_grp_name');
        $name = ($name == '') ? strtolower(sanitizeForUrl($title)) : $name;

        if ($name) {
            $exists = safe_field('id', 'smd_um_groups', "name='".doSlash($name)."'");

            if ($exists) {
                $this->message = array(gTxt('smd_um_grp_exists', array('{id}' => $exists)), E_USER_WARNING);
            } else {
                // It's not atomic but it'll do, given that:
                //  a) normally only one person administers this plugin.
                //  b) groups are added one at a time.
                $curr_max = safe_field("MAX(id)", 'smd_um_groups', '1=1');
                $new_priv = ($curr_max + 1);
                safe_insert('smd_um_groups', "id='" . $new_priv . "', name='" . doSlash($name) . "'");
                $this->upsert_lang($title, $name);

                $based_on = ps('smd_um_new_grp_based_on');

                if ($based_on != '') {
                    assert_int($based_on);

                    // Can't rely on the privs being in the database so resort to the (merged) array.
                    foreach ($txp_permissions as $area => $privs) {
                        $privs = do_list($privs);
                        $safe_area = doSlash($area);

                        if (in_array($based_on, $privs, true)) {
                            $current_privs = safe_column('priv', 'smd_um_privs', "area='{$safe_area}'");

                            if (empty($current_privs)) {
                                $priv_set = array_unique(array_merge($privs, array($new_priv)));
                            } else {
                                $priv_set = array($new_priv);
                            }

                            foreach ($priv_set as $np) {
                                safe_insert('smd_um_privs', "area='{$safe_area}', priv='" . doSlash($np) . "'");
                            }
                        }
                    }
                }

                $this->message = gTxt('smd_um_grp_created', array('{name}' => $name));
            }
        } else {
            $this->message = array(gTxt('smd_um_name_required'), E_ERROR);
        }

        $this->groups($evt);
    }

    /**
     * Delete a group if it's not in the core set.
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     */
    public function group_del($evt, $stp)
    {
        require_privs($this->event.'.smd_um_grp');

        $id = assert_int(gps('id'));
        $name = safe_field('name', 'smd_um_groups', "id='".$id."' AND core!=1");

        if ($name) {
            // @todo Make atomic.
            $red = safe_delete('smd_um_groups', "id=$id AND core!=1");
            safe_delete('txp_lang', "name='".doSlash($name)."'");
            $affected_users = safe_column('user_id', 'txp_users', "privs = $id");

            if ($affected_users) {
                // Set all orphaned users to no privs -- can always assign them a new group from the main screen later
                $ret = safe_update('txp_users', "privs=0", "user_id IN ('". implode("','", doSlash($affected_users)) ."')");
            }

            if ($red) {
                $ret = safe_delete('smd_um_privs', "priv=$id");
                $this->message = gTxt('smd_um_grp_deleted') . ($affected_users ? gTxt('smd_um_grp_affected', array('{num}' => count($affected_users))) : '');
            }
        } else {
            $this->message = array(gTxt('smd_um_grp_not_deleted'), E_ERROR);
        }

        $this->groups($evt);
    }

    /**
     * Save the group set.
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     */
    public function group_save($evt, $stp)
    {
        require_privs($this->event.'.smd_um_grp');

        $excluded = $this->get_groups(0);
        $ids = ps('smd_um_group_id');
        $names = ps('smd_um_group_name');
        $titles = ps('smd_um_group_title');

        foreach ($ids as $idx => $id) {
            $title = $titles[$idx];
            $name = strtolower(sanitizeForUrl($names[$idx]));

            // Can't create duplicate types
            if (!in_array($name, $excluded)) {
                safe_update('smd_um_groups', "name='" . doSlash($name) . "'", "id='" . doSlash($id) . "'");
            }

            $this->upsert_lang($title, $name);
        }

        $this->message = gTxt('smd_um_grp_saved');
        $this->groups($evt);
    }

    /**
     * Group management panel.
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     */
    public function groups($evt, $stp = '')
    {
        require_privs($this->event.'.smd_um_grp');

        $msg = $this->message;

        // Render the page.
        pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_grp_lbl'), $msg);
        $btnbar = array();
        $this->buttons($this->event, '', $btnbar);
        $allgroups = $this->get_groups(1, true);
        $grouplist = selectInput('smd_um_new_grp_based_on', $allgroups, '', true, '', 'smd_um_new_grp_based_on');

        // New group.
        echo '<h1 class="txp-heading">', gTxt('smd_um_heading_grp'), '</h1>',
            n. '<div id="'.$this->event.'_control" class="txp-control-panel">',
            n. implode(n, $btnbar),
            n. form(
                graf(
                    '<label for="smd_um_new_grp">' . gTxt('smd_um_grp_new') . '</label>'
                    .n.fInput('text', 'smd_um_new_grp', '', '', '', '', '', '', 'smd_um_new_grp')
                    .n.'<label for="smd_um_new_grp_name">' . gTxt('smd_um_grp_new_name') . '</label>'
                    .n.fInput('text', 'smd_um_new_grp_name', '', '', '', '', '', '', 'smd_um_new_grp_name')
                    .n.'<label for="smd_um_new_grp_based_on">' . gTxt('smd_um_based_on') . '</label>'
                    .n.$grouplist
                    .n.fInput('submit', 'smd_um_group_add', gTxt('create'))
                    .n.eInput($this->event)
                    .n.sInput('smd_um_group_add')
                    )
                , '','','post','search-form'
                ),
            n, '</div>';

        // Retrieve the group info and user counts per privilege level.
        $fields = 'smdg.id, smdg.name, smdg.core, txu.total AS user_count';
        $clause = ' FROM '.PFX.'smd_um_groups AS smdg
            LEFT JOIN (SELECT privs, count(privs) AS total FROM '.PFX.'txp_users GROUP BY privs) AS txu ON smdg.id = txu.privs';

        $rs = getRows('SELECT ' . $fields.$clause . ' ORDER BY id');

        if ($rs) {
            echo n. '<div class="plugin-column">'
                .n. '<form action="index.php" id="smd_um_grp_form" method="post" name="longform" onsubmit="return verify(\''.gTxt('are_you_sure').'\')">'
                .n.'<div class="txp-listtables">'
                .n. startTable('', '', 'txp-list')
                .n. '<thead>'
                .n. tr(
                    hCell('ID', '', ' class="id"').
                    hCell(gTxt('title'), '', ' class="name"').
                    hCell(gTxt('name'), '', ' class="name"').
                    hCell('', '', '')
                )
                .n. '</thead>'
                .n. '<tbody>';

            foreach ($rs as $row) {
                extract(doSpecial($row));
                $user_count = empty($user_count) ? 0 : $user_count;
                $dLink = ($core) ? '&nbsp;' : dLink($this->event, 'smd_um_group_del', 'id', $id, false, null, null, true);
                echo tr(
                    tda(
                        hInput('smd_um_group_id[]', $id)
                        .(($user_count) ? eLink($this->event, '', 'search_method', 'privs', $id, 'crit', $id) : $id)
                    , ' class="id"'
                        .(($user_count) ? ' title="' . gTxt('smd_um_user_count') . $user_count . '"': '')
                    )
                    .td(fInput('text', 'smd_um_group_title[]', gTxt($name)), '', 'name')
                    .td(fInput('text', 'smd_um_group_name[]', $name), '', 'name')
                    .td($dLink)
                );
            }

            echo n. '</tbody>'
                .n. endTable()
                .n. '</div>'
                .n. graf(fInput('submit', 'smd_um_group_save', gTxt('save'), 'publish'))
                .n. fInput('hidden', 'smd_um_grp_del', '', '', '', '', '', '', 'smd_um_grp_del')
                .n. eInput($this->event)
                .n. sInput('smd_um_group_save')
                .n. tInput()
                .n. '</form>'
                .n. '</div>';
        }
    }

    /**
     * Save the given privilege set.
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     */
    public function priv_save($evt, $stp)
    {
        global $txp_permissions;

        require_privs($this->event.'.smd_um_prv');

        $areas = ps('smd_um_areas');

        foreach ($areas as $area) {
            $ar_fakename = '__'.str_replace('.', '---', $area);
            $privs = ps($ar_fakename);
            $privs = $privs ? $privs: array();
            $area = strtolower(sanitizeForPage($area));
            $safe_area = doSlash($area);

            $current_privs = safe_column('priv', 'smd_um_privs', "area='{$safe_area}'");
            $default_privs = isset($txp_permissions[$area]) ? do_list($txp_permissions[$area]) : array();
            $diff_added = array_diff($privs, $default_privs);
            $diff_removed = array_diff($current_privs, $privs);

            // Only alter privs if they differ from what's already stored.
            if ($diff_added || $diff_removed) {
                // Delete the old area privs if they exist.
                safe_delete('smd_um_privs', "area='{$safe_area}'");

                if (is_array($privs)) {
                    foreach ($privs as $priv) {
                        // Reset should always be first in the list since it's the first checkbox col.
                        // If reset, don't add the privs again (thus they will be read from admin_config.php).
                        if ($priv == 'smd_um_reset') {
                            break;
                        } else {
                            assert_int($priv);
                            safe_insert('smd_um_privs', "area='{$safe_area}', priv='" . doSlash($priv) . "'");
                        }
                    }
                }
            }
        }

        // Merge the changes into the priv table
        $this->priv_merge(false, true);
        $this->message = gTxt('smd_um_prv_saved');
        $this->privs($evt, $stp);
    }

    /**
     * Add a privilege set.
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     */
    public function priv_add($evt, $stp)
    {
        global $txp_permissions;

        require_privs($this->event.'.smd_um_prv');

        $name = ps('smd_um_new_prv');
        $name = strtolower(sanitizeForPage($name));

        if ($name) {
            if (strpos($name, 'smd_um') === 0) {
                // Can't create privs for this plugin
                $this->message = array(gTxt('smd_um_prv_smd_um'), E_USER_WARNING);
            } else {
                $exists = array_key_exists($name, $txp_permissions);
                if ($exists) {
                    $this->message = array(gTxt('smd_um_prv_exists'), E_USER_WARNING);
                } else {
                    safe_insert('smd_um_privs', "area='" . doSlash($name) . "'");

                    $this->priv_merge(false, true);
                    $this->message = gTxt('smd_um_prv_created', array('{area}' => $name));
                }
            }
        } else {
            $this->message = array(gTxt('smd_um_name_required'), E_ERROR);
        }

        $this->privs($evt, $stp);
    }

    /**
     * Privs management panel.
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     */
    public function privs($evt, $stp = '')
    {
        global $txp_permissions;

        require_privs($this->event.'.smd_um_prv');

        $msg = $this->message;

        $grouplist_name = $this->get_groups(0);
        $grouplist_title = $this->get_groups(1);
        unset($grouplist_name[0]); // Don't want None privs
        unset($grouplist_title[0]); // Ditto

        $curr_area = '';
        $area_count = 0;
        $thatts = ' class="smd_um_grp_name" title="' . gTxt('smd_um_sel_grp') . '"';
        $headers = '<thead>'.tr(
            hCell('', '', ' class="smd_um_sel_area" title="' . gTxt('smd_um_sel_all') . '"')
            .hCell(gTxt('smd_um_reset'), '', ' class="smd_um_reset_col" title="' . gTxt('smd_um_sel_reset') . '"')
            .hCell(implode('</th><th'.$thatts.'>', $grouplist_title), '', $thatts)
        , ' class="smd_um_prv_hdr"'). '</thead>';

        $viz = do_list(get_pref('pane_smd_um_priv_visible'));

        pagetop(gTxt('smd_um_tab_name').' &raquo; '.gTxt('smd_um_prv_lbl'), $msg);
        $btnbar = array();
        $this->buttons($this->event, '', $btnbar);
        $formToken = form_token();

        echo '<h1 class="txp-heading">', gTxt('smd_um_heading_prv'), '</h1>',
            n. '<div id="'.$this->event.'_control" class="txp-control-panel">',
            n. implode(n, $btnbar).
            n. form(
                graf(
                    '<label for="smd_um_new_prv">' . gTxt('smd_um_prv_new') . '</label>'
                    .n.fInput('text', 'smd_um_new_prv', '', '', '', '', '', '', 'smd_um_new_prv')
                    .n.fInput('submit', 'smd_um_priv_add', gTxt('create'))
                    .n.eInput($this->event)
                    .n.sInput('smd_um_priv_add')
                    )
                , '','','post','search-form'
                ).
            n. '</div>';

        echo n. '<form action="index.php" id="smd_um_privilege_form" method="post" name="longform" onsubmit="return verify(\''.gTxt('are_you_sure').'\')">'
            .n. eInput($this->event).sInput('smd_um_priv_save').tInput();

        foreach ($txp_permissions as $area => $privs) {
            $priv_list = do_list($privs);
            $area_parts = do_list($area, '.');

            if (preg_match('/^([A-Za-z0-9]{3,3})\_/', $area_parts[0], $matches)) {
                // Plugin.
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

                echo n. '<div class="smd_um_privgroup"><h3 class="txp-summary lever'. ($is_viz ? ' expanded' : ''). '"><a href="#'. $ref. '">'. $area_parts[0]. (($area_parts[0] != $area_head) ? ' ('. gTxt($area_parts[0]). ')' : ''). '</a></h3>'
                    .n. '<div id="'. $ref. '" class="toggle" style="display:'. ($is_viz ? 'block' : 'none'). '">'
                    .n. fInput('submit', 'smd_um_priv_save', gTxt('save'), 'smd_um_privsave publish')
                    .n. startTable('', '', 'txp-list')
                    .n. $headers
                    .n. '<tbody>';
            }

            $privboxes = array();
            // Dots aren't valid characters for a name so replace them now and swap them back upon Save.
            // Similarly, area names like 'lang' clash with core variables, so prefix them with __ here.
            $safe_area = '__'.str_replace('.', '---', $area).'[]';

            foreach ($grouplist_name as $id => $priv) {
                $privboxes[] = td(checkbox($safe_area, $id, (in_array($id, $priv_list))), '', 'smd_um_checkbox');
            }

            echo tr(
                tda($area.hInput('smd_um_areas[]', $area), ' class="smd_um_prv_name" title="' . gTxt('smd_um_sel_prv') . '"')
                .td(checkbox($safe_area, 'smd_um_reset', 0), '', 'smd_um_resetbox')
                .implode(n, $privboxes)
            );

            $curr_area = $area_parts[0];
            $area_count++;
        }

        echo n. endTable()
            .n. '</div></div>'
            .n. fInput('hidden', 'smd_um_prv_del', '', '', '', '', '', '', 'smd_um_prv_del')
            .n. '</form>';

        echo script_js(<<<EOJS
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
    }

    /**
     * Jump to the prefs panel from the Options link on the Plugins panel.
     */
    public function options()
    {
        $link = '?event=prefs#prefs_group_smd_user_manager';

        header('Location: ' . $link);
    }

    /**
     * Add buttons to the interface based on privs.
     *
     * @param string $evt     Textpattern event (panel)
     * @param string $stp     Textpattern step (action)
     * @param array  $buttons Current UI button set
     * @return array          Updated buttons based on user privs
     */
    public function buttons($evt, $stp, &$buttons)
    {
        global $step;

        if (strpos($step, 'smd_um_') === 0 && has_privs('admin.edit')) {
            $buttons[] = sLink($this->event, null, gTxt('tab_site_admin'), 'txp-button');
        }

        if (has_privs($this->event.'.smd_um_grp')) {
            $buttons[] = sLink($this->event, 'smd_um_groups', gTxt('smd_um_grp_lbl'), 'txp-button');
        }

        if (has_privs($this->event.'.smd_um_prv')) {
            $buttons[] = sLink($this->event, 'smd_um_privs', gTxt('smd_um_prv_lbl'), 'txp-button');
        }
    }

    /**
     * Merge/edit the groups & privs into the existing global arrays.
     *
     * @param bool $do_grp  Whether to merge the custom groups with core
     * @param bool $do_priv Whether to merge the custom privileges with core
     * @param bool $replace Whether to append (false) or replace (true) the privs/groups
     */
    protected function priv_merge($do_grp = true, $do_priv = true, $replace = false)
    {
        global $txp_groups, $txp_permissions;

        $smd_um_prefs = $this->get_prefs();

        if ($do_grp && $this->table_exist('smd_um_groups')) {
            $new_groups = safe_rows('id, name', 'smd_um_groups', '1=1');

            $txp_groups = $replace ? array() : $txp_groups;

            foreach ($new_groups as $row) {
                $txp_groups[$row['id']] = $row['name'];
            }

            ksort($txp_groups);
        }

        if ($do_priv && $this->table_exist('smd_um_privs')) {
            $new_privs = safe_rows('area, GROUP_CONCAT(priv) AS privs', 'smd_um_privs', '1=1 GROUP BY area ORDER BY area');

            // Allow this plugin's strings to be skipped if we don't want people upsetting the plugin's behaviour.
            $self_edit = get_pref('smd_um_self_alter', $smd_um_prefs['smd_um_self_alter']['default']);

            $txp_permissions = $replace ? array() : $txp_permissions;

            foreach ($new_privs as $row) {
                if (strpos($row['area'], 'smd_um') === false || $self_edit) {
                    $txp_permissions[$row['area']] = $row['privs'];
                }
            }

            ksort($txp_permissions);
        }
    }

    /**
     * Show who's currently online(ish).
     *
     * @param string $evt  Textpattern event (panel)
     * @param string $stp  Textpattern step (action)
     * @param string $data The current footer content
     */
    public function active_users($evt, $stp, $data)
    {
        $smd_um_prefs = $this->get_prefs();

        $curr_users = json_decode(get_pref('smd_um_current_users', '', 1), true);
        $timeout = get_pref('smd_um_active_timeout', $smd_um_prefs['smd_um_active_timeout']['default']);
        $online = array();

        if (is_array($curr_users)) {
            foreach ($curr_users as $user => $last_access) {
                $still_active = strtotime("+$timeout seconds", $last_access);

                if (($still_active !== false) && ($still_active > time())) {
                    $online[] = eLink($this->event, '', 'search_method', 'login', $user, 'crit', $user);
                }
            }
        }

        return (($online)
            ? graf(gTxt('smd_um_active', array('{users}' => implode(', ', $online)), 'raw'),
                array('class' => 'smd_um_active_users'))
            : '').$data;
    }

    /**
     * Add/update any language string for group name.
     *
     * Note this may leave orphan strings if the name is changed.
     *
     * @param string $title New string content
     * @param string $name  Language key to create/replace. Use sanitized $title if omitted
     */
    public function upsert_lang($title, $name = '')
    {
        global $DB;

        $lang = get_pref('language_ui', TEXTPATTERN_DEFAULT_LANG);
        $name = (isset($name) && $name != '') ? $name : strtolower(sanitizeForUrl($title));
        $table = 'txp_lang';
        $where = "name='" . doSlash($name) . "' AND lang='" . doSlash($lang) . "'";

        // Try to update first.
        $ret = safe_update($table, "data='" . doSlash($title) . "'", $where);

        if ($ret && (mysqli_affected_rows($DB->link) || safe_count($table, $where))) {
            // Do nothing -- record has been updated
        } else {
            safe_insert($table, "event='admin', owner='smd_user_manager', name='" . doSlash($name) . "', lang='" . doSlash($lang) . "', data='" . doSlash($title) . "'");
        }

        // Update the on-page strings so the changes are reflected immediately.
        $textarray[$name] = $title;
        Txp::get('\Textpattern\L10n\Lang')->setPack($textarray, true);
    }

    /**
     * Fetch a set of user roles filtered by the prefs
     *
     * @param  integer $type  Whether to fetch the groups by name (0) or title (1)
     * @param  bool    $force Always fetch from the database (don't rely on cache)
     * @return array          Available user roles
     */
    public function get_groups($type = 0, $force = false)
    {
        global $txp_groups, $txp_user;
        static $permitted_users = array();

        if (!$force && isset($permitted_users[$type])) {
            return $permitted_users[$type];
        }

        $this->priv_merge(true, false, $force);
        $smd_um_prefs = $this->get_prefs();

        $levels = ($type) ? get_groups() : $txp_groups;
        $tiered = get_pref('smd_um_hierarchical_groups', $smd_um_prefs['smd_um_hierarchical_groups']['default']);
        $curr_priv = safe_field('privs', 'txp_users', "name = '" .doSlash($txp_user). "'");

        if ($this->table_exist('smd_um_groups')) {
            $protected = get_pref('smd_um_admin_group', $smd_um_prefs['smd_um_admin_group']['default']);
            $grp = safe_rows('id, name', 'smd_um_groups', '1=1');

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

    /**
     * Add group/priv tables if not already installed and install prefs.
     */
    public function install()
    {
        global $DB, $txp_groups, $txp_permissions, $prefs;

        $currentVersion = get_pref('smd_user_manager_version', 'base');

        if ($currentVersion === 'base' || $currentVersion < $this->version) {
            $GLOBALS['txp_err_count'] = 0;
            $ret = '';
            $sql = array();

            // In truth, this table should be normalised further, but for the sake
            // of one row per priv level per area, it's quicker than a join, and
            // using GROUP_CONCAT() gets the priv table as in admin.config.php
            $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX."smd_um_privs` (
                `area` varchar(127) NOT NULL default '',
                `priv` smallint NOT NULL default 0,
                PRIMARY KEY (`area`,`priv`)
            ) ENGINE=MyISAM";

            // id is NOT an auto_increment column because autoinc doesn't allow
            // a 0 entry, which we need for 'None'
            $sql[] = "CREATE TABLE IF NOT EXISTS `".PFX."smd_um_groups` (
                `id` smallint(4) NOT NULL default 0,
                `name` varchar(64) NOT NULL default '',
                `core` bool NOT NULL default 0,
                PRIMARY KEY (`id`)
            ) ENGINE=MyISAM PACK_KEYS=1";

            // Handle upgrades: be kind to beta testers.
            if ($this->table_exist('smd_um_privs')) {
                $flds = getThings('SHOW COLUMNS FROM `'.PFX.'smd_um_privs`');

                if (in_array('core', $flds)) {
                    $sql[] = "ALTER TABLE `".PFX."smd_um_privs` DROP `core`";
                }
            }

            // Append initial value population to query stack if this is a new install.
            if (!$this->table_exist('smd_um_groups')) {
                foreach ($txp_groups as $id => $name) {
                    $sql[] = "INSERT INTO `".PFX."smd_um_groups` VALUES ('$id', '$name', 1)";
                }
            }

            if (!$this->table_exist('smd_um_privs')) {
                foreach ($txp_permissions as $area => $privs) {
                    $priv_list = do_list($privs);

                    foreach ($priv_list as $priv) {
                        if (is_numeric($priv)) {
                            $sql[] = "INSERT INTO `".PFX."smd_um_privs` VALUES ('$area', '$priv')";
                        }
                    }
                }
            }

            if (gps('debug')) {
                dmp($sql);
            }

            foreach ($sql as $qry) {
                $ret = safe_query($qry);

                if ($ret === false) {
                    $GLOBALS['txp_err_count']++;
                    echo "<b>".$GLOBALS['txp_err_count'].".</b> ".mysqli_error($DB->link)."<br />\n";
                    echo "<!--\n $qry \n-->\n";
                }
            }

            // Spit out results
            if ($GLOBALS['txp_err_count'] == 0) {
                $msg = gTxt('smd_um_tbl_installed');
            } else {
                $msg = gTxt('smd_um_tbl_not_installed');
            }

            // Install the prefs.
            $plugprefs = $this->get_prefs();

            foreach ($plugprefs as $name => $opts) {
                if (get_pref($name, null) === null) {
                    set_pref(
                        $name,
                        (isset($opts['default']) ? $opts['default'] : ''),
                        (isset($opts['event']) ? $opts['event'] : 'smd_user_manager'),
                        (isset($opts['type']) ? $opts['type'] : PREF_PLUGIN),
                        (isset($opts['html']) ? $opts['html'] : 'text_input'),
                        $opts['position'],
                        (isset($opts['scope']) ? $opts['scope'] : PREF_GLOBAL)
                    );
                } else {
                    $expectedType = isset($opts['type']) ? $opts['type'] : PREF_PLUGIN;
                    $expectedHtml = isset($opts['html']) ? $opts['html'] : 'text_input';

                    if (safe_field('type', 'txp_prefs', "name='".doSlash($name)."'") != $expectedType) {
                        safe_update('txp_prefs', "type=".$expectedType, "name='".doSlash($name)."'");
                    }

                    if (safe_field('html', 'txp_prefs', "name='".doSlash($name)."'") !== $expectedHtml) {
                        safe_update('txp_prefs', "html='".$expectedHtml."'", "name='".doSlash($name)."'");
                    }
                }
            }

            // Update the installed version number.
            set_pref('smd_user_manager_version', $this->version, 'smd_user_manager', 2, '', 0);
            $prefs['smd_user_manager_version'] = $this->version;
        }
    }

    /**
     * Drop table if in database
     */
    public function remove()
    {
        global $DB;

        $ret = '';
        $sql = array();
        $GLOBALS['txp_err_count'] = 0;

        if ($this->table_exist(1)) {

            $sql[] = "DROP TABLE IF EXISTS " .PFX. "smd_um_privs; ";
            $sql[] = "DROP TABLE IF EXISTS " .PFX. "smd_um_groups; ";

            if (gps('debug')) {
                dmp($sql);
            }

            foreach ($sql as $qry) {
                $ret = safe_query($qry);

                if ($ret === false) {
                    $GLOBALS['txp_err_count']++;
                    echo "<b>".$GLOBALS['txp_err_count'].".</b> ".mysqli_error($DB->link)."<br />\n";
                    echo "<!--\n $qry \n-->\n";
                }
            }
        }

        if ($GLOBALS['txp_err_count'] == 0) {
            $msg = gTxt('smd_um_tbl_removed');
        } else {
            $msg = gTxt('smd_um_tbl_not_removed');
            $this->smd_um($msg);
        }

        safe_delete(
            'txp_prefs',
            "name like 'smd\_um\_%' OR name like 'smd\_user\_manager\_%'"
        );

        // @todo delete Textpack.
    }

    /**
     * Test if the table(s) exist and/or have the correct column count.
     *
     * There's no core mechanism to show tables, so resort to
     * mysqli_query() for these tests.
     *
     * @param  string $which The table to check for existence/integrity
     * @return bool          Whether the table is properly installed or not
     */
    public function table_exist($which = '')
    {
        global $DB;

        static $smd_um_installed = array();

        // The number of expected cols in each table.
        $tbls = array(
            'smd_um_groups' => 3,
            'smd_um_privs' => 2,
        );

        if ($which && array_key_exists($which, $tbls) && isset($smd_um_installed[$which])) {
            return ($smd_um_installed[$which] == $tbls[$which]);
        }

        if ($which == '1') {
            $out = count($tbls);

            foreach ($tbls as $tbl => $cols) {
                $res = mysqli_query($DB->link, "SHOW TABLES LIKE '".PFX.$tbl."'");

                if (mysqli_fetch_row($res) !== NULL) {
                    $num = count(safe_show('columns', $tbl));
                    $smd_um_installed[$tbl] = $num;
                    $out -= ($tbls[$tbl] == $num) ? 1 : 0;
                }
            }

            return ($out === 0) ? 1 : 0;
        } elseif (array_key_exists($which, $tbls)) {
            $res = mysqli_query($DB->link, "SHOW TABLES LIKE '".PFX.$which."'");

            if (mysqli_fetch_row($res) !== NULL) {
                $num = count(safe_show('columns', $which));
                $smd_um_installed[$which] = $num;

                return ($smd_um_installed[$which] == $tbls[$which]);
            }

            return false;
        }

        return false;
    }

    /**
     * Render a user group select list.
     *
     * @param  string $key The input control key
     * @param  string $val The currently selected value. Default used if unset
     * @return string      HTML
     */
    public static function selectlist($key, $val)
    {
        $prefobj = self::get_prefs();

        return selectInput($key, $prefobj[$key]['content'], ($val ? $val : $prefobj[$key]['default']));
    }

    /**
     * Settings for the plugin
     */
    public static function get_prefs()
    {
        $smd_um_prefs = array(
            'smd_um_hierarchical_groups' => array(
                'html'     => 'yesnoradio',
                'type'     => PREF_PLUGIN,
                'position' => 10,
                'default'  => '0',
                'group'    => 'smd_um_settings',
            ),
            'smd_um_admin_group' => array(
                'html'     => __CLASS__ . '->selectlist',
                'type'     => PREF_PLUGIN,
                'position' => 20,
                'content'  => get_groups(),
                'default'  => '1',
                'group'    => 'smd_um_settings',
            ),
            'smd_um_active_timeout' => array(
                'html'     => 'text_input',
                'type'     => PREF_PLUGIN,
                'position' => 50,
                'default'  => '60',
                'group'    => 'smd_um_settings',
            ),
            'smd_um_self_alter' => array(
                'html'     => 'yesnoradio',
                'type'     => PREF_PLUGIN,
                'position' => 60,
                'default'  => '0',
                'group'    => 'smd_um_settings',
            ),
        );

        return $smd_um_prefs;
    }
}
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
h1. smd_user_manager

h2. Features

Complete user / group / privilege management. Features:

* Augments the _Admin>Users_ panel.
* Add / edit / list / filter users as normal, with additional content counts alongside each.
* Quickly find accounts with certain characteristics (e.g. self-registered spam accounts with 0 articles).
* Create new user groups (a.k.a. roles) if the default six aren't enough.
* Rename existing groups to more suitable names (you cannot delete them).
* Modify Textpattern's standard privilege areas to alter what each user group can see/do.
* Add new priv areas (useful for custom code to save doing it in a plugin).
* A "who's online" indicator for admins.

h2. Installation / uninstallation

p(important). Requires Txp 4.8.6+

Download the plugin from either "the Textpattern plugins repo":https://plugins.textpattern.com/plugins/smd_user_manager, "GitHub":https://github.com/Bloke/smd_user_manager, or "my software page":https://stefdawson.com/sw, paste the code into the Txp _Admin->Plugins_ panel, install and enable the plugin. The tables will be installed and populated automatically unless you use the plugin from the cache directory; in either case, visiting the _Admin->User manager_ tab will install and populate them.

To uninstall the plugin, first assign all your users to groups in Txp's first six, then delete the plugin from the _Admin->Plugins_ panel. The tables will be deleted automatically. If you do not reassign users to those default groups, you may have users with 'dangling' (i.e. no) privs. The outcome of what happens when such users log in is thus undefined: at the very least you'll get admin-side errors thrown.

Visit the "forum thread":http://forum.textpattern.com/viewtopic.php?id=36558 for more info or to report on the success or otherwise of the plugin.

h2. Admin side overview

Visit the _Admin->User manager_ tab. The default view (for admins) is a list of users. There are buttons at the top of the screen: __Change password__, "Users":#smd_um_users, "Groups":#smd_um_groups, and "Privs":#smd_um_privs. Each of those displays an area for the management of that component.

h2(#smd_um_users). User management (_Users_ button)

View / search the installed user base as normal. Additional columns on display are:

* Articles -- number of articles authored by this user
* Images -- number of images uploaded by this user
* Files -- number of files uploaded by this user
* Links -- number of links created by this user

Click an article / image / file / link value to see the content owned by that user.

Filter and sort the columns as usual by clicking the headings, using the Column display options or the Search box. Note that:

* When searching privileges by name, only the _first matching_ group will be returned -- the privs are searched in order of their ID.
* You may search privileges and content counts by specifying an exact value, for example Article count: 0 shows all accounts with no articles (perhaps a self-registered spammer or malicious user?)
* You may also search these fields using greater-than or less-than symbols to find users with the matching number of assets. For example, Image count: @>=50@ shows all users with 50 images or more.

A common use is to find any users with 0 articles, and then use the multi-edit tool to delete them all.

h2(#smd_um_groups). Group management (_Groups_ button)

This panel allows you to alter the names of Txp's built-in 6 groups to suit your application. It changes the Titles in the currently installed language only.

You may also add a new group using the input controls and accompanying _Create_ button at the top of the panel. If you choose to only enter a Title, a name will be automatically generated (lower case, with most non-ASCII characters replaced by safe characters). Alternatively, you can type your own name, though please stick to 'simple' letters and numbers to make things easy on yourself later. If you choose an existing group from the _based on_ dropdown, the privs for that group will be copied across to your new group.

Custom groups can be deleted using the 'x' button alongside each. Any users that were assigned to that group will have their privileges reduced to 'None'. Either visit the _Users_ panel and alter their priv level to something suitable, or set their level to something else prior to deleting the group.

If any group contains at least one user, the group ID values are hyperlinked back to the Users panel to show only those users in that group. This is handy for reassigning priv levels before deleting a group. If you hover over the priv ID, a tooltip will display the number of users assigned to that privilege group.

h2(#smd_um_privs). Priv management (_Privs_ button)

From this panel you may alter which user groups can access which parts of the admin side interface or perform certain types of action. You will see a list of 'area' headings. Click one to expand it and see the privileges it contains; click it again to collapse it. The open/closed state of the areas is remembered next time you visit the panel.

Each area has a row of checkboxes alongside it. If a checkbox is ticked in a column corresponding to a privilege group, that group has access to that feature of the interface. You may alter who sees what by changing the tick boxes and hitting one of the _Save_ buttons in each area heading; all the buttons do the same thing: they save the entire list of privileges. You must confirm the action, because the change is immediate.

You may change checkboxes in batches by selecting rows/columns and then using a keyboard shortcut to make changes to all highlighted checkboxes. Firstly, choose which checkboxes to apply your changes:

# click a column heading to highlight that entire Group
# click a row heading to highlight that entire Priv set
# click the top left-hand corner of the set to select all checkboxes

You can select multiple columns/rows from multiple areas if you wish. Clicking a row/column/corner heading again will toggle its status.

When you are ready to make changes to the selected checkboxes, you can use the following keys:

* @c@ to check all selected boxes
* @u@ to uncheck all selected boxes
* @t@ to toggle the status of all selected boxes (checked become unchecked, and vice versa)
* @d@ deselects all rows / columns you have highlighted

The area headings merely group the areas for convenience and make the page look less scary! Any plugins you have installed will be shown under an area heading of the author's three-letter prefix. Note that altering privs here overrides the privs as set by the plugin so you can customise who sees what, _as long as the plugin in question is loaded before smd_user_manager_. Check the plugin load order values if things aren't working as you expect.

The 'tab' area heading governs which user groups have access to the primary navigation areas (content, presentation, admin, extensions and any custom tabs such as those created by smd_tabber). Note that giving access to these tabs does not automatically give access to the secondary navigation elements; you must turn those on independently. By contrast, giving a user group access to a secondary navigation item _does_ allow them to use that feature but they won't be able to navigate to it using the primary navigation button unless they have also been given access to that tab.

For example, if you grant the 'page' privilege to Freelancers but don't give them access to the Presentation tab, they could type @?event=page@ in the URL to get to the Pages panel but they would have no means of navigating there by clicking the menu. Since the primary 'Presentation' tab is missing, the secondary tabs are all missing too, even though some of them may be permitted for that group of users.

If you wish to add your own priv area, type a new one in the box at the top of the panel and hit _Create_. Your area will be created under the appropriate heading, e.g. if you specified @smd_test@ it would appear under the @smd@ heading, or if you created a @file.trusted@ privilege area, it would appear under the @file@ heading. Core areas are normally specified by a dotted notation but you are free to choose any notation that makes sense to your application.

Note that:

# some plugins may not show up in the list due to factors such as plugin load order or the mechanism by which the plugin is written.
# the @[R]@ column is a special Reset indicator. Checking any row in this column will ignore any privilege checkboxes you may have set or altered and will reset the corresponding privs to their defaults after you click Save.
# by default you may not add @smd_um@ privs to override the functionality of this plugin, although you can adjust who can edit what so be careful not to open the permissions too widely. A preference setting governs whether smd_um can have its own privs altered.
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

At the bottom of each back-end panel, admins can see a list of currently active ("online") users. Each user is hyperlinked to the "Users":#smd_um_users panel to show you the info about just that person, which is a convenient shortcut to find out about a logged-in author.

An active user is one who has performed some admin-side action in the past N seconds, where N is defined in the "Activity Timeout plugin preference":#smd_um_prefs.

h2. Public side tag

h3(#smd_um_has_privs). Tag: @<txp:smd_um_has_privs>@

Use this conditional tag to check if the currently logged-in user has permissions to perform some action. If they have, the contained content is executed. Supports @<txp:else />@.

Note that the plugin does not have a public-side logging in/out facility, it merely allows you to test whether someone who has logged in via the admin side (or via a third party login plugin) has necessary privileges.

Attributes:

; *name*
: Check the current logged-in user's name against this list of names.
: IMPORTANT: Case sensitive.
; *group*
: Check the current logged-in user's group (privilege) level is in this list of numbers.
: You can specify @>@ and @<@ symbols before any value to indicate you wish to check if the user has privileges higher or lower than a given number, respectively.
: If checking priv values less than a number, 0 (a.k.a None) is _never_ included: you must add it to the list explicitly if you wish to test for it.
: Example: @group="11, <4"@ means "does the user have privs of 11, 1, 2, or 3?"
; *area*
: Check the current logged-in user has the ability to access one of the given areas in this list.
: Example: @area="sports_hall, chemistry_lab"@ would only perform the contained content if the logged-in user's priv level was present in either the sports_hall or chemistry_lab priv areas.

Notes:

* You can combine the attributes in any way: the contained content will only be executed if the logged-in user matches *all* the criteria.
* Without any attributes, the contained content will be executed if anybody is logged in, regardless of their name, privs or assigned areas.
* Again: login @name@s are case sensitive

h2. Author / credits

Written by "Stef Dawson":https://stefdawson.com/contact. Thanks to the beta test team jakob, mrdale, alanfluff, maverick, Destry, redbot, and rsilletti for their willingness to let my code loose on their servers.

# --- END PLUGIN HELP ---
-->
<?php
}
?>
<?php if (!defined('access') or !access) {
    die('This file cannot be directly accessed.');
} ?>
<?php G\Render\include_theme_header();
function read_the_docs_settings($key, $subject)
{
    return '📖 '._s('Learn about %s settings at our %d.', [
        '%s' => $subject,
        '%d' => get_docs_link('settings/' . $key . '.html', _s('documentation')),
    ]);
}

function get_docs_link($key, $subject)
{
    return '<a href="' . get_documentationBaseUrl() . $key . '" target="_blank">' . $subject . '</a>';
}
?>

<div class="content-width">

	<div class="form-content">

		<div class="header header-tabs">
			<h1><?php _se('Dashboard'); ?></h1>
			<?php G\Render\include_theme_file('snippets/tabs'); ?>
		</div>
		<?php
        switch (get_dashboard()) {
            case 'stats':
        ?>
				<div data-modal="modal-connecting-ip" class="hidden">
					<span class="modal-box-title"><?php _se('Not your IP?'); ?></span>
					<div class="connecting-ip"><?php echo G\get_client_ip(); ?></div>
					<p><?php _se("The connecting IP is determined using the server variable %var%. If the detected IP doesn't match yours, it means that your web server is under a proxy and you need to tweak your server to set the real connecting IP.", ['%var%' => '<code class="code">$_SERVER[\'REMOTE_ADDR\']</code>']); ?></p>
					<p><?php _se("For Nginx, you must use %nginx%. For Apache, %apache%.", [
                                '%nginx%' => '<code class="code">ngx_http_realip_module</code>',
                                '%apache%' => '<code class="code">mod_remoteip</code>'
                            ]); ?></p>
					<p><?php _se("Make sure that you address this issue as the system relies on accurate IP detections to provide basic functionalities and to protect against spam, flooding, and brute force attacks."); ?></p>
				</div>
				<div class="dashboard-group">
					<div class="overflow-auto text-align-center margin-top-20">
						<a href="<?php echo G\get_base_url('dashboard/images'); ?>" class="stats-block c6 fluid-column display-inline-block" <?php if (get_totals()['images'] > 999999) {
                                echo ' rel="tooltip" data-tipTip="top" title="' . number_format(get_totals()['images']) . '"';
                            } ?>>
							<span class="stats-big-number">
								<strong class="number"><?php echo get_totals()['images'] > 999999 ? get_totals_display()['images'] : number_format(get_totals()['images']); ?></strong>
								<span class="label"><?php _ne('Image', 'Images', get_totals()['images']); ?></span>
							</span>
						</a>
						<a href="<?php echo G\get_base_url('dashboard/albums'); ?>" class="stats-block c6 fluid-column display-inline-block" <?php if (get_totals()['albums'] > 999999) {
                                echo ' rel="tooltip" data-tipTip="top" title="' . number_format(get_totals()['albums']) . '"';
                            } ?>>
							<span class="stats-big-number">
								<strong class="number"><?php echo get_totals()['albums'] > 999999 ? get_totals_display()['albums'] : number_format(get_totals()['albums']); ?></strong>
								<span class="label"><?php _ne('Album', 'Albums', get_totals()['albums']); ?></span>
							</span>
						</a>
						<a href="<?php echo G\get_base_url('dashboard/users'); ?>" class="stats-block c6 fluid-column display-inline-block" <?php if (get_totals()['users'] > 999999) {
                                echo ' rel="tooltip" data-tipTip="top" title="' . number_format(get_totals()['users']) . '"';
                            } ?>>
							<span class="stats-big-number">
								<strong class="number"><?php echo get_totals()['users'] > 999999 ? get_totals_display()['users'] : number_format(get_totals()['users']); ?></strong>
								<span class="label"><?php _ne('User', 'Users', get_totals()['users']); ?></span>
							</span>
						</a>
						<div class="stats-block c6 fluid-column display-inline-block">
							<div class="stats-big-number">
								<strong class="number"><?php echo get_totals_display()['disk']['used']; ?> <span><?php echo get_totals_display()['disk']['unit']; ?></span></strong>
								<span class="label"><?php _se('Disk used'); ?></span>
							</div>
						</div>
					</div>

					<ul class="tabbed-content-list table-li margin-top-20">
                        <li>
                            <span class="c6 display-table-cell padding-right-10">GitHub<span style="opacity: 0;">:</span></span>
                            <span class="display-table-cell vertical-align-middle" style="line-height: 1;">
                                <a class="github-button" href="https://github.com/rodber/chevereto-free/subscription" data-icon="octicon-eye" data-size="large" data-show-count="true" aria-label="Watch rodber/chevereto-free on GitHub">Watch</a>
                                <a class="github-button" href="https://github.com/rodber/chevereto-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star rodber/chevereto-free on GitHub">Star</a>
                            </span>
                            <div class="highlight padding-5 margin-top-10 margin-bottom-10">Chevereto-Free project ownership will be <b>transferred</b> to <a href="https://github.com/rodber" target="_blank">rodber</a> on <b>2021-10</b>.
                                <ul class="list-style-type-disc padding-left-20">
                                    <li>The Chevereto organization won't be longer involved with the development of this project.</li>
                                    <li>The project repository will be available at <a href="https://github.com/rodber/chevereto-free" target="_blank">rodber/chevereto-free</a>.</li>
                                </ul>
                            </div>
                        </li>
						<?php
                        foreach (get_system_values() as $v) {
                            ?>
							<li><span class="c6 display-table-cell padding-right-10"><?php echo $v['label']; ?><span style="opacity: 0;">:</span></span><span class="display-table-cell"><?php echo $v['content']; ?></span></li>
						<?php
                        }
                        ?>
					</ul>

				</div>
				
			</ul>
			<script async defer src="https://buttons.github.io/buttons.js"></script>
			
        </div>

        <?php
                break;
            case 'bulk':
            ?>
				<div class="header header--centering default-margin-bottom">
					<h1><?php _se('Bulk importer'); ?></h1>
                </div>
                <div class="text-content">
                    <p><?php _se('This tool allows to mass add content to your website by pointing a system path with the content you want to import. It supports the addition of users, albums, and images using a folder based structure.'); ?> <?php _se('Check the %s for more information about this feature.', get_docs_link('features/bulk-content-importer.html', _s('documentation'))); ?></p>
                </div>
                <div class ="text-content margin-bottom-20">
                <h3>🤖 <?php _se('Automatic importing'); ?></h3>
                    <p><?php _se('The system automatically parses any content by a continuous observation of the %path% path.', ['%path%' => '<b>' . G_ROOT_PATH . 'importing</b>']); ?> <?php _se('Completed jobs will be automatically re-started after %n %m.', [
                        '%n' => '1',
                        '%m' => _n('minute', 'minutes', '1')
                    ]); ?> <?php _se('Reset to clear stats and logs.'); ?></p>
                </div>
                <div data-content="dashboard-imports" class="margin-top-0 margin-bottom-20">
                <?php
                $statusesDisplay = [
                    'queued' => _s('Queued'),
                    'working' => _s('Working'),
                    'paused' => _s('Paused'),
                    'canceled' => _s('Canceled'),
                    'completed' => _s('Completed'),
                ];
                if ($continuous = CHV\Import::getContinuous()) {
                    foreach ($continuous as $v) {
                        $boxTpl = '<div class="importing phone-c1 phablet-c1 c8 fluid-column display-inline-block" data-status="%status%" data-id="%id%" data-object="%object%" data-errors="%errors%" data-started="%started%">
                        <h3 class="margin-bottom-5">Path <b title="%path%">%pathRelative%</b></h3>
                        <span data-content="log-errors" class="icon icon-warning color-red position-absolute top-10 right-10"></span>
                        <div data-content="pop-selection" class="pop-btn">
                        <span class="pop-btn-text">' . _s('Actions') . '<span class="arrow-down"></span></span>
                            <div class="pop-box arrow-box arrow-box-top anchor-left">
                                <div class="pop-box-inner pop-box-menu">
                                    <ul>
                                        <li data-action="reset"><a>' . _s('Reset') . '</a></li>
                                        <li data-action="pause"><a>' . _s('Pause') . '</a></li>
                                        <li data-action="resume"><a>' . _s('Resume') . '</a></li>
                                        <li data-content="log-process"><a href="' . G\get_base_url('importer-jobs/%id%/process') . '" target="_blank">' . _s('Process log') . '</a></li>
                                        <li data-content="log-errors"><a href="' . G\get_base_url('importer-jobs/%id%/errors') . '" target="_blank"><span class="icon icon-warning color-red"></span> ' . _s('Errors') . '</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="importing-stats">
                            <span class="figure"><span data-content="images">%images%</span> images</span>
                            <span class="figure"><span data-content="albums">%albums%</span> albums</span>
                            <span class="figure"><span data-content="users">%users%</span> users</span>
                        </div>
                        <div class="importing-status">' . _s('Status') . ': <span data-content="status">%displayStatus%</span></div>
                        <div class="importing-status">@<span data-content="dateTime">%dateTime%</span> UTC</div>
                        <div class="loading-container position-absolute right-10 bottom-10"><div class="loading"></div></div>
                        </div>';
                        echo strtr($boxTpl, [
                            '%id%' => $v['id'],
                            '%dateTime%' => $v['time_updated'],
                            '%object%' => htmlspecialchars(json_encode($v), ENT_QUOTES, 'UTF-8'),
                            '%status%' => $v['status'],
                            '%parse%' => $v['options']['root'],
                            '%shortParse%' => $v['options']['root'][0],
                            '%displayStatus%' => $statusesDisplay[$v['status']],
                            '%path%' => $v['path'],
                            '%pathRelative%' => '.' . G\absolute_to_relative($v['path']),
                            '%users%' => $v['users'] ?: 0,
                            '%images%' => $v['images'] ?: 0,
                            '%albums%' => $v['albums'] ?: 0,
                            '%errors%' => $v['errors'] ?: 0,
                            '%started%' => $v['started'] ?: 0,
                        ]);
                    }
                } ?>
                </div>
                <div class="margin-bottom-40">
                    <div class="margin-bottom-10"><?php _se('The system works with a scheduled command to continuously process the importing. It requires a crontab entry.'); ?></div>
                    <div class="margin-bottom-10">
                        <code class="code">* * * * * IS_CRON=1 THREAD_ID=1 /usr/bin/php <?php echo G_ROOT_PATH . 'importing.php'; ?> >/dev/null 2>&1</code>
                    </div>
                    <div class="margin-bottom-10"><?php _se('You can run the command in parallel by changing the integer value of %s%.', ['%s%' => '<code>THREAD_ID</code>']); ?></div>
                    <div class="margin-bottom-10">
                        <span class="highlight padding-5 display-inline-block">⚠ <?php _se('All file-system permissions must be granted for the crontab user at %path%', ['%path%' => G_ROOT_PATH . 'importing']);  ?></span>
                    </div>
                </div>
            </div>

				<div data-modal="modal-add-import" class="hidden" data-submit-fn="CHV.fn.import.add.submit" data-ajax-deferred="CHV.fn.import.add.deferred">
					<span class="modal-box-title"><?php _se('Add import job'); ?></span>
					<div class="modal-form">
						<?php G\Render\include_theme_file('snippets/form_import_add'); ?>
					</div>
				</div>
				<div data-modal="modal-process-import" data-prompt="skip" class="hidden" data-load-fn="CHV.fn.import.process.load" data-submit-fn="CHV.fn.import.process.submit" data-ajax-deferred="CHV.fn.import.process.deferred">
					<span class="modal-box-title"><?php _se('Process import'); ?></span>
					<div class="modal-form">
						<?php G\Render\include_theme_file('snippets/form_import_process'); ?>
					</div>
				</div>
				<?php
                if ($imports = CHV\Import::getOneTime()) {
                    foreach ($imports as $k => &$v) {
                        if ($v['status'] != 'working') {
                            continue;
                        }
                        $then = strtotime($v['time_updated']);
                        $now = strtotime(G\datetimegmt());
                        if ($now > ($then + 300)) { // 5 min
                            $v['status'] = 'paused';
                            CHV\DB::update('imports', ['status' => 'paused'], ['id' => $v['id']]);
                        }
                    }
                    $imports = array_reverse($imports);
                }
                $rowTpl = '<li data-status="%status%" data-id="%id%" data-object="%object%" data-errors="%errors%" data-started="%started%">
			<span class="fluid-column c2 col-2-max display-table-cell padding-right-10">%id%</span>
			<span class="fluid-column c2 col-2-max display-table-cell padding-right-10 text-transform-uppercase" title="' . _s('Top level folders as %s', '%parse%') . '">%shortParse%</span>
			<span class="fluid-column c3 col-3-max display-table-cell padding-right-10">
				<span class="icon icon-warning2 color-red" data-result="error"></span>
				<span class="icon icon-checkmark-circle color-green" data-result="success"></span>
				<span class="status-text">%displayStatus%</span>
			</span>
			<span class="fluid-column c7 col-7-max col-7-min display-table-cell padding-right-10 text-overflow-ellipsis phone-display-block" title="%path%">%path%</span>
			<span class="fluid-column c2 display-table-cell padding-right-10"><span>%users%</span><span class="table-li--mobile-display"> ' . _s('Users') . '</span></span>
			<span class="fluid-column c2 display-table-cell padding-right-10"><span>%albums%</span><span class="table-li--mobile-display"> ' . _s('Albums') . '</span></span>
			<span class="fluid-column c3 display-table-cell padding-right-10"><span>%images%</span><span class="table-li--mobile-display"> ' . _s('Images') . '</span></span>
			<div class="fluid-column c3 display-table-cell margin-bottom-0 phone-display-block">
				<div class="loading"></div>
				<div data-content="pop-selection" class="pop-btn">
					<span class="pop-btn-text">' . _s('Actions') . '<span class="arrow-down"></span></span>
					<div class="pop-box arrow-box arrow-box-top anchor-left">
						<div class="pop-box-inner pop-box-menu">
							<ul>
								<li data-args="%id%" data-modal="form" data-target="modal-process-import"><a>' . _s('Process') . '</a></li>
								<li data-action="pause"><a>' . _s('Pause') . '</a></li>
								<li data-action="cancel"><a>' . _s('Cancel') . '</a></li>
								<li data-content="log-process"><a href="' . G\get_base_url('importer-jobs/%id%/process') . '" target="_blank">' . _s('Process log') . '</a></li>
								<li data-content="log-errors"><a href="' . G\get_base_url('importer-jobs/%id%/errors') . '" target="_blank">' . _s('Errors') . '</a></li>
								<li data-args="%id%" data-confirm="' . _s('Do you really want to remove the import ID %s?', '%id%') . '" data-submit-fn="CHV.fn.import.delete.submit" data-ajax-deferred="CHV.fn.import.delete.deferred"><a>' . _s('Delete') . '</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
        </li>';
                $manualImportingClass = is_array($imports) == false ? ' hidden' : '';
                ?>
                <div class="text-content">
                    <h3>⚙ <?php _se('Manual importing'); ?></h3>
                    <p><?php _se('The system will parse the contents of any available filesystem path.'); ?> <?php _se('These processes must be manually created and handled with the web browser tab open.'); ?> <a data-modal="form" data-target="modal-add-import"><?php _se('Add import job'); ?></a></p>
                </div>
                
				<ul data-content="dashboard-imports" class="tabbed-content-list table-li-hover table-li margin-top-20 margin-bottom-20<?php echo $manualImportingClass; ?>">
					<li class="table-li-header phone-hide">
						<span class="fluid-column c2 display-table-cell">ID</span>
						<span class="fluid-column c2 display-table-cell"><?php _se('Parser'); ?></span>
						<span class="fluid-column c3 display-table-cell"><?php _se('Status'); ?></span>
						<span class="fluid-column c7 col-7-max col-7-min display-table-cell"><?php _se('Path'); ?></span>
						<span class="fluid-column c2 display-table-cell"><?php _se('Users'); ?></span>
						<span class="fluid-column c2 display-table-cell"><?php _se('Albums'); ?></span>
						<span class="fluid-column c3 display-table-cell"><?php _se('Images'); ?></span>
						<span class="fluid-column c3 display-table-cell">&nbsp;</span>
					</li>
					<?php
                    if (is_array($imports)) {
                        foreach ($imports as $k => $v) {
                            echo strtr($rowTpl, [
                                '%id%' => $v['id'],
                                '%object%' => htmlspecialchars(json_encode($v), ENT_QUOTES, 'UTF-8'),
                                '%status%' => $v['status'],
                                '%parse%' => $v['options']['root'],
                                '%shortParse%' => $v['options']['root'][0],
                                '%displayStatus%' => $statusesDisplay[$v['status']],
                                '%path%' => $v['path'],
                                '%users%' => $v['users'] ?: 0,
                                '%images%' => $v['images'] ?: 0,
                                '%albums%' => $v['albums'] ?: 0,
                                '%errors%' => $v['errors'] ?: 0,
                                '%started%' => $v['started'] ?: 0,
                            ]);
                        }
                    }
                    ?>
				</ul>
				<script>
					$(document).ready(function() {
						CHV.obj.import = {
							working: {
								// importId: {
								// 	threads: {threadId: xhr},
								// 	interval: interval,
								// 	stats: xhr
								// }
							},
							aborted: [],
							boxTpl: <?php echo json_encode($boxTpl); ?>,
							rowTpl: <?php echo json_encode($rowTpl); ?>,
							importTr: {
								'id': null,
								// 'object' : null,
								'status': null,
								'parse': null,
								'shortParse': null,
								'displayStatus': null,
								'path': null,
								'users': null,
								'images': null,
								'albums': null,
								'errors': null,
								'started': null,
							},
							sel: {
								root: "[data-content=dashboard-imports]",
								header: ".table-li-header"
							},
							statusesDisplay: <?php echo json_encode($statusesDisplay); ?>
                        };
                        var updateContinuous = function( object) {
                            var $sel = $("[data-id=" + object.id + "]", CHV.obj.import.sel.root);
                            $sel.attr({
                                "data-status": object.status,
                                "data-object": JSON.stringify(object),
                                "data-errors": object.errors,
                                "data-started": object.started,
                            });
                            $("[data-content=images]", $sel).text(object.images);
                            $("[data-content=dateTime]", $sel).text(object.time_updated);
                            $("[data-content=users]", $sel).text(object.users);
                            $("[data-content=albums]", $sel).text(object.albums);
                            $("[data-content=status]", $sel).text(CHV.obj.import.statusesDisplay[object.status]);
                        };
                        $('.importing', '[data-content=dashboard-imports]').each(function(i, v) {
                            var id = $(this).data("id");
                            var $this = $(this);
                            CHV.obj.import.working[id] = {
                                threads: {},
                                interval: setInterval(function() {
                                    var $loading = $this.find(".loading");
                                    if($loading.html() !== "") {
                                        $loading.removeClass("hidden");
                                    } else {
                                        PF.fn.loading.inline($loading, {
                                            size: "small"
                                        });
                                    }
                                    CHV.obj.import.working[id].stats = $.ajax({
                                        type: "POST",
                                        data: {
                                            action: "importStats",
                                            id: id
                                        }
                                    });
                                    CHV.obj.import.working[id].stats.complete(function (XHR) {
                                        var response = XHR.responseJSON;
                                        if (response) {
                                            updateContinuous(response.import);
                                        }
                                        $loading.addClass("hidden");
                                    });
                                }, 10000),
                                stats: {}
                            };
                            
                        });
                        $(document).on("click", CHV.obj.import.sel.root + " [data-action]", function() {
                            var $el = $(this).closest("[data-object]");
                            var $loading = $el.find(".loading");
                            var $actions = $el.find("[data-content=pop-selection]");
                            var localData = $el.data("object");
                            var backupData = $.extend({}, localData);
                            var action = $(this).data("action");
                            var data = {};
                            if (localData.id) {
                                data.id = localData.id;
                            }
                            if($el.is("li")) {
                                CHV.fn.import.process.abortAll(data.id);
                            }
                            switch (action) {
                                case "resume":
                                    data.action = "importResume";
                                    localData.status = "working";
                                    break;
                                case "reset":
                                    data.action = "importReset";
                                    localData.status = "working";
                                    break;
                                case "pause":
                                    data.action = "importEdit";
                                    localData.status = "paused";
                                    data.values = {
                                        status: localData.status
                                    };
                                    break;
                                case "cancel":
                                    localData.status = "canceled";
                                    data.action = "importEdit";
                                    data.values = {
                                        status: localData.status
                                    };
                                    break;
                                case "process":
                                    localData.status = "working";
                                    data.action = "importEdit";
                                    data.values = {
                                        status: localData.status
                                    };
                                    break;
                                default:
                                    alert('null');
                                    return;
                                    break;
                            }
                            if($loading.html() !== "") {
                                $loading.removeClass("hidden");
                            } else {
                                PF.fn.loading.inline($loading, {
                                    size: "small"
                                });
                            }
                            $actions.addClass("pointer-events-none");
                            $.ajax({
                                type: "POST",
                                data: data
                            }).complete(function(XHR) {
                                var response = XHR.responseJSON;
                                if (XHR.status == 200) {
                                    var dataset = response.import;
                                    if($el.is("li")) {
                                        var $html = CHV.fn.import.parseTemplate(dataset);
                                        $el.replaceWith($html);
                                        if (action == "process") {
                                            CHV.fn.import.process.deferred.success(XHR);
                                        }
                                    } else {
                                        updateContinuous(response.import);
                                    }
                                } else {
                                    PF.fn.growl.call(response.error.message);
                                }
                                
                                $loading.addClass("hidden");
                                $actions.removeClass("pointer-events-none");
                            });
                        });
                    });
                    
				</script>
			<?php
                break;

            case 'images':
            case 'albums':
            case 'users':
                global $tabs;
                $tabs = get_sub_tabs();
            ?>
				<div class="header header-tabs margin-bottom-10 follow-scroll">
					<?php G\Render\include_theme_file('snippets/tabs'); ?>
					<?php
                    global $user_items_editor;
                    $user_items_editor = false;
                    G\Render\include_theme_file('snippets/user_items_editor');
                    ?>
					<div class="header-content-right phone-float-none">
						<?php G\Render\include_theme_file('snippets/listing_tools_editor'); ?>
					</div>

					<?php if (get_dashboard() == 'users') {
                        ?>
						<div class="header-content-right phone-float-none">
							<div class="list-selection header--centering">
								<a class="header-link" data-modal="form" data-target="modal-add-user"><?php _se('Add user'); ?></a>
							</div>
						</div>
						<div data-modal="modal-add-user" class="hidden" data-submit-fn="CHV.fn.user.add.submit" data-ajax-deferred="CHV.fn.user.add.complete">
							<span class="modal-box-title"><?php _se('Add user'); ?></span>
							<div class="modal-form">
								<div class="input-label c7">
									<label for="form-role"><?php _se('Role'); ?></label>
									<select name="form-role" id="form-role" class="text-input">
										<option value="user" selected><?php _se('User'); ?></option>
										<option value="manager"><?php _se('Manager'); ?></option>
										<option value="admin"><?php _se('Administrator'); ?></option>
									</select>
								</div>
								<div class="input-label c11">
									<label for="username"><?php _se('Username'); ?></label>
									<input type="text" name="form-username" id="form-username" class="text-input" maxlength="<?php echo CHV\Settings::get('username_max_length'); ?>" rel="tooltip" data-tipTip="right" pattern="<?php echo CHV\Settings::get('username_pattern'); ?>" rel="tooltip" data-title='<?php echo strtr('%i to %f characters<br>Letters, numbers and "_"', ['%i' => CHV\Settings::get('username_min_length'), '%f' => CHV\Settings::get('username_max_length')]); ?>' maxlength="<?php echo CHV\Settings::get('username_max_length'); ?>" placeholder="<?php _se('Username'); ?>" required>
									<span class="input-warning red-warning"></span>
								</div>
								<div class="input-label c11">
									<label for="form-name"><?php _se('Email'); ?></label>
									<input type="email" name="form-email" id="form-email" class="text-input" placeholder="<?php _se('Email address'); ?>" required>
									<span class="input-warning red-warning"></span>
								</div>
								<div class="input-label c11">
									<label for="form-name"><?php _se('Password'); ?></label>
									<input type="password" name="form-password" id="form-password" class="text-input" title="<?php _se('%d characters min', CHV\Settings::get('user_password_min_length')); ?>" pattern="<?php echo CHV\Settings::get('user_password_pattern'); ?>" rel="tooltip" data-tipTip="right" placeholder="<?php _se('Password'); ?>" required>
									<span class="input-warning red-warning"></span>
								</div>
							</div>
						</div>
					<?php
                    } ?>
				</div>

				<div id="content-listing-tabs" class="tabbed-listing">
					<div id="tabbed-content-group">
						<?php
                        G\Render\include_theme_file('snippets/listing');
                        ?>
					</div>
				</div>
			<?php
                break;
            case 'settings':
                function personal_mode_warning()
                {
                    if (CHV\getSetting('website_mode') == 'personal') {
                        echo '<div class="input-below"><span class="icon icon-info color-red"></span> ' . _s('This setting is always diabled when using personal website mode.') . '</div>';
                    }
                }
            ?>
				<form id="dashboard-settings" method="post" data-type="<?php echo get_dashboard(); ?>" data-action="validate" enctype="multipart/form-data">

					<?php echo G\Render\get_input_auth_token(); ?>

					<div class="header header--centering default-margin-bottom follow-scroll">
						<h1>
							<span class="icon icon-cog phablet-hide tablet-hide laptop-hide desktop-hide"></span>
							<span class="phone-hide"><?php echo get_dashboard_menu()[get_dashboard()]['label']; ?></span>
						</h1>
						<div data-content="pop-selection" class="pop-btn pop-keep-click header-link float-left margin-left-10" data-action="settings-switch">
							<span class="pop-btn-text margin-left-5"><?php echo get_settings()['label']; ?><span class="arrow-down"></span></span>
							<div class="pop-box pbcols3 anchor-left arrow-box arrow-box-top">
								<div class="pop-box-inner pop-box-menu pop-box-menucols">
									<ul>
										<?php
                                        foreach (get_settings_menu() as $item) {
                                            ?>
											<li<?php if ($item['current']) {
                                                echo ' class="current"';
                                            } ?>><a href="<?php echo $item['url']; ?>"><?php echo $item['label']; ?></a></li>
											<?php
                                        }
                                            ?>
									</ul>
								</div>
							</div>
						</div>
						<?php if (get_settings()['key'] == 'categories') { ?>
							<div class="header-content-right phone-float-none">
								<div class="list-selection header--centering">
									<a class="header-link" data-modal="form" data-target="modal-add-category"><?php _se('Add category'); ?></a>
								</div>
							</div>
							<div data-modal="modal-add-category" class="hidden" data-submit-fn="CHV.fn.category.add.submit" data-before-fn="CHV.fn.category.add.before" data-ajax-deferred="CHV.fn.category.add.complete">
								<span class="modal-box-title"><?php _se('Add category'); ?></span>
								<div class="modal-form">
									<?php G\Render\include_theme_file('snippets/form_category_edit'); ?>
								</div>
							</div>
						<?php
                                            } ?>
						<?php if (get_settings()['key'] == 'ip-bans') { ?>
							<div class="header-content-right phone-float-none">
								<div class="list-selection header--centering">
									<a class="header-link" data-modal="form" data-target="modal-add-ip_ban"><?php _se('Add IP ban'); ?></a>
								</div>
							</div>
							<div data-modal="modal-add-ip_ban" class="hidden" data-submit-fn="CHV.fn.ip_ban.add.submit" data-before-fn="CHV.fn.ip_ban.add.before" data-ajax-deferred="CHV.fn.ip_ban.add.complete">
								<span class="modal-box-title"><?php _se('Add IP ban'); ?></span>
								<div class="modal-form">
									<?php G\Render\include_theme_file('snippets/form_ip_ban_edit'); ?>
								</div>
							</div>
						<?php
                                            } ?>
				<?php
                        if (get_settings()['key'] == 'pages') {
                            switch (get_settings_pages()['doing']) {
                                case 'add':
                                case 'edit':
                                    $pages_top_link = [
                                        'href' => 'dashboard/settings/pages',
                                        'text' => _s('Return to pages'),
                                    ];
                                    break;
                                default:
                                    $pages_top_link = [
                                        'href' => 'dashboard/settings/pages/add',
                                        'text' => _s('Add page'),
                                    ];
                                    break;
                            } ?>
							<div class="header-content-right phone-hide">
								<div class="list-selection header--centering">
									<a class="header-link" href="<?php echo G\get_base_url($pages_top_link['href']); ?>"><?php echo $pages_top_link['text']; ?></a>
								</div>
							</div>
						<?php
                        } ?>
					</div>

					<?php
                    if (get_dashboard() == 'settings') {
                        ?>

						<?php if (get_settings()['key'] == 'website') { ?>
                            <p><?php echo read_the_docs_settings('website', _s('website')); ?></p>
							<div class="phablet-c1">
								<div class="input-label">
									<label for="website_name"><?php _se('Website name'); ?></label>
									<input type="text" name="website_name" id="website_name" class="text-input" value="<?php echo G\safe_html(CHV\Settings::get('website_name')); ?>" required>
									<div class="input-warning red-warning"><?php echo get_input_errors()['website_name']; ?></div>
								</div>
								<div class="input-label">
									<label for="website_doctitle"><?php _se('Website doctitle'); ?></label>
									<input type="text" name="website_doctitle" id="website_doctitle" class="text-input" value="<?php echo G\safe_html(CHV\Settings::get('website_doctitle')); ?>">
								</div>
								<div class="input-label">
									<label for="website_description"><?php _se('Website description'); ?></label>
									<input type="text" name="website_description" id="website_description" class="text-input" value="<?php echo G\safe_html(CHV\Settings::get('website_description')); ?>">
									<div class="input-warning red-warning"><?php echo get_input_errors()['website_description']; ?></div>
								</div>
							</div>

							<hr class="line-separator">

							<div class="phablet-c1">
								<div class="input-label">
									<label for="website_https">HTTPS</label>
									<div class="c5 phablet-c1"><select type="text" name="website_https" id="website_https" class="text-input">
											<?php
                                            echo CHV\Render\get_select_options_html(['auto' => _s('Automatic'), 'forced' => _s('Forced'), 'disabled' => _s('Disabled')], CHV\Settings::get('website_https')); ?>
										</select></div>
									<div class="input-below"><?php _se("%a will use HTTPS detection on the server side (recommended). %f will use HTTPS regardless of your server setup. %d to don't use HTTPS at all.", ['%a' => '"' . _s('Automatic') . '"', '%f' => '"' . _s('Forced') . '"', '%d' => '"' . _s('Disabled') . '"']); ?></div>
									<div class="input-below"><span class="highlight"><?php _se("This only controls the protocol used in the URLs, it won't turn your website into a valid HTTPS website unless your server is configured to support and use HTTPS."); ?></span></div>
								</div>
							</div>

							<hr class="line-separator">

							<?php
                            $zones = timezone_identifiers_list();
                            foreach ($zones as $tz) {
                                $zone = explode('/', $tz);
                                $subzone = $zone;
                                array_shift($subzone);
                                $regions[$zone[0]][$tz] = join('/', $subzone);
                            } ?>

							<div class="input-label">
								<label for="timezone-region"><?php _se('Default time zone'); ?></label>
								<div class="overflow-auto">
									<div class="c5 phablet-c1 phone-c1 grid-columns phone-margin-bottom-10 phablet-margin-bottom-10 margin-right-10">
										<select id="timezone-region" class="text-input" data-combo="timezone-combo">
											<option><?php _se('Select region'); ?></option>
											<?php
                                            $default_timezone = explode('/', CHV\Settings::get('default_timezone'));
                            foreach ($regions as $key => $region) {
                                $selected = $default_timezone[0] == $key ? ' selected' : '';
                                echo '<option value="' . $key . '"' . $selected . '>' . $key . '</option>';
                            } ?>
										</select>
									</div>
									<div id="timezone-combo" class="c5 phablet-c1 grid-columns">
										<?php
                                        foreach ($regions as $key => $region) {
                                            $show_hide = $default_timezone[0] == $key ? '' : ' soft-hidden';
                                            if (count($region) == 1) {
                                                $show_hide .= ' hidden';
                                            } ?>
											<select id="timezone-combo-<?php echo $key; ?>" class="text-input switch-combo<?php echo $show_hide; ?>" data-combo-value="<?php echo $key; ?>">
												<?php
                                                foreach ($region as $k => $l) {
                                                    $selected = CHV\Settings::get('default_timezone') == $k ? ' selected' : '';
                                                    echo '<option value="' . $k . '"' . $selected . '>' . $l . '</option>' . "\n";
                                                } ?>
											</select>
										<?php
                                        } ?>
									</div>
								</div>
								<input type="hidden" id="default_timezone" name="default_timezone" data-content="timezone" data-highlight="#timezone-region" value="<?php echo CHV\Settings::get('default_timezone', true); ?>" required>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="website_search"><?php _se('Search'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="website_search" id="website_search" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('website_search')); ?>
									</select></div>
								<div class="input-below"><?php _se('Allows to search images, albums and users based on a given search query.'); ?></div>
							</div>

							<div class="input-label">
								<label for="website_explore_page"><?php _se('Explore'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="website_explore_page" id="website_explore_page" class="text-input" data-combo="website-explore-combo">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('website_explore_page')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enables to browse public uploaded images. It also enables categories.'); ?></div>
							</div>

							<div id="website-explore-combo">
								<div data-combo-value="1" class="switch-combo phablet-c1<?php if ((get_safe_post() ? get_safe_post()['website_explore_page'] : CHV\Settings::get('website_explore_page')) != 1) {
                                            echo ' soft-hidden';
                                        } ?>">
									<div class="input-label">
										<label for="website_explore_page_guest"><?php _se('Explore'); ?> (<?php _se('guests'); ?>)</label>
										<div class="c5 phablet-c1"><select type="text" name="website_explore_page_guest" id="website_explore_page_guest" class="text-input">
												<?php
                                                echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('website_explore_page_guest')); ?>
											</select></div>
										<div class="input-below"><?php _se('Enables explore for guests.'); ?></div>
									</div>
								</div>
							</div>

							<div class="input-label">
								<label for="website_random"><?php _se('Random'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="website_random" id="website_random" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('website_random')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enables to browse images randomly.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="website_mode"><?php _se('Website mode'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="website_mode" id="website_mode" class="text-input" data-combo="website-mode-combo">
										<?php
                                        echo CHV\Render\get_select_options_html(['community' => _s('Community'), 'personal' => _s('Personal')], CHV\Settings::get('website_mode')); ?>
									</select></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['website_mode']; ?></div>
								<div class="input-below"><?php _se('You can switch the website mode anytime.'); ?></div>
							</div>

							<div id="website-mode-combo">

								<div data-combo-value="personal" class="switch-combo phablet-c1<?php if ((get_safe_post() ? get_safe_post()['website_mode'] : CHV\Settings::get('website_mode')) != 'personal') {
                                            echo ' soft-hidden';
                                        } ?>">

									<hr class="line-separator">

									<div class="input-label">
										<label for="website_mode_personal_uid"><?php _se('Personal mode target user'); ?></label>
										<div class="c3"><input type="number" min="1" name="website_mode_personal_uid" id="website_mode_personal_uid" class="text-input" value="<?php echo CHV\Settings::get('website_mode_personal_uid'); ?>" placeholder="<?php _se('User ID'); ?>" rel="tooltip" title="<?php _se('Your user id is: %s', CHV\Login::getUser()['id']); ?>" data-tipTip="right" data-required></div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['website_mode_personal_uid']; ?></div>
										<div class="input-below"><?php _se('Numeric ID of the target user for personal mode.'); ?></div>
									</div>
									<div class="input-label">
										<label for="website_mode_personal_routing"><?php _se('Personal mode routing'); ?></label>
										<div class="c5"><input type="text" name="website_mode_personal_routing" id="website_mode_personal_routing" class="text-input" value="<?php echo CHV\Settings::get('website_mode_personal_routing'); ?>" placeholder="/"></div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['website_mode_personal_routing']; ?></div>
										<div class="input-below"><?php _se('Custom route to map /username to /something. Use "/" to map to homepage.'); ?></div>
									</div>

									<hr class="line-separator">

								</div>

							</div>

							<div class="input-label">
								<label for="website_privacy_mode"><?php _se('Website privacy mode'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="website_privacy_mode" id="website_privacy_mode" class="text-input" data-combo="website-privacy-mode-combo">
										<?php
                                        echo CHV\Render\get_select_options_html(['public' => _s('Public'), 'private' => _s('Private')], CHV\Settings::get('website_privacy_mode')); ?>
									</select></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['website_privacy_mode']; ?></div>
								<div class="input-below"><?php _se('Private mode will make the website only available for registered users.'); ?></div>
							</div>

							<div id="website-privacy-mode-combo">
								<div data-combo-value="private" class="switch-combo phablet-c1<?php if ((get_safe_post() ? get_safe_post()['website_privacy_mode'] : CHV\Settings::get('website_privacy_mode')) != 'private') {
                                            echo ' soft-hidden';
                                        } ?>">
									<div class="input-label">
										<label for="website_content_privacy_mode"><?php _se('Content privacy mode'); ?></label>
										<div class="c5 phablet-c1"><select type="text" name="website_content_privacy_mode" id="website_content_privacy_mode" class="text-input">
												<?php
                                                echo CHV\Render\get_select_options_html([
                                                    'default' => _s('Default'),
                                                    'private' => _s('Force private (self)'),
                                                    'private_but_link' => _s('Force private (anyone with the link)'),
                                                ], CHV\Settings::get('website_content_privacy_mode')); ?>
											</select></div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['website_content_privacy_mode']; ?></div>
										<div class="input-below"><?php _se('Forced privacy modes will override user selected privacy.'); ?></div>
									</div>
								</div>
							</div>

						<?php
                        } ?>

						<?php
                        if (get_settings()['key'] == 'pages') {
                            // So ugly!

                            switch (get_settings_pages()['doing']) {
                                case 'display':
                                    break;
                                case 'add':
                                    $page = [];
                                    $page_db = [];
                                    break;
                                case 'edit':
                                    $page = get_page();
                                    global $page_db;
                                    $page_db = [];
                                    foreach ($page as $k => $v) {
                                        $page_db['page_' . $k] = $v;
                                    }

                                    break;
                            }

                            function get_page_val($key, $from = 'POST')
                            {
                                global $page_db;
                                if (empty($key)) {
                                    return null;
                                }
                                if ($from == 'POST' and $_POST) {
                                    return get_safe_post()[$key];
                                } else {
                                    switch (get_settings_pages()['doing']) {
                                        case 'add':
                                            return null;
                                            break;
                                        case 'edit':
                                            return array_key_exists($key, $page_db) ? $page_db[$key] : null;
                                            break;
                                    }
                                }
                            } ?>
							<?php if (get_settings_pages()['title']) {
                                ?>
								<h3><?php echo get_settings_pages()['title']; ?></h3>
							<?php
                            } ?>

							<?php if (get_settings_pages()['doing'] !== 'listing') {
                                ?>

								<div class="input-label">
									<label for="page_title"><?php _se('Title'); ?></label>
									<div class="c9 phablet-c1"><input type="text" name="page_title" id="page_title" class="text-input" value="<?php echo get_page_val('page_title'); ?>" required placeholder="<?php _se('Page title'); ?>"></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_title']; ?></div>
								</div>

								<div class="input-label">
									<label for="page_is_active"><?php _se('Page status'); ?></label>
									<div class="c5 phablet-c1"><select type="text" name="page_is_active" id="page_is_active" class="text-input">
											<?php
                                            echo CHV\Render\get_select_options_html([1 => _s('Active page'), 0 => _s('Inactive page (%s)', '404')], (int) get_page_val('page_is_active')); ?>
										</select></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_is_active']; ?></div>
									<div class="input-below"><?php _se('Only active pages will be accessible.'); ?></div>
								</div>

								<div class="input-label">
									<label for="page_type"><?php _se('Type'); ?></label>
									<div class="c5 phablet-c1"><select type="text" name="page_type" id="page_type" class="text-input" data-combo="page-type-combo">
											<?php
                                            echo CHV\Render\get_select_options_html(['internal' => _s('Internal'), 'link' => _s('Link')], get_page_val('page_type')); ?>
										</select></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_type']; ?></div>
								</div>

								<div id="page-type-combo">

									<?php

                                    $pagesAll = CHV\Page::getAll();
                                $internals = [
                                        'tos' => _s('Terms of service'),
                                        'privacy' => _s('Privacy'),
                                        'contact' => _s('Contact'),
                                    ];
                                $printInternals = [
                                        null => _s('Extra page'),
                                    ];
                                $takenInternals = [];
                                if ($pagesAll) {
                                    foreach ($pagesAll as $k => $v) {
                                        if ($v['internal'] && $internals[$v['internal']]) {
                                            $takenInternals[] = $v['internal'];
                                            if (function_exists('get_page') && get_page()['id'] == $v['id']) {
                                                $printInternals[$v['internal']] = $internals[$v['internal']];
                                            }
                                        }
                                    }
                                }
                                foreach ($internals as $k => $v) {
                                    if (in_array($k, $takenInternals) == false) {
                                        $printInternals[$k] = $v;
                                    }
                                }
                                $page_internal_combo_visible = get_settings_pages()['doing'] == 'edit' ? (get_page_val('page_type') == 'internal') : true; ?>
									<div data-combo-value="internal" class="switch-combo phablet-c1<?php if (!$page_internal_combo_visible) {
                                    echo ' soft-hidden';
                                } ?>">

										<div class="input-label">
											<label for="page_internal"><?php _se('Internal page type'); ?></label>
											<div class="c5 phablet-c1"><select type="text" name="page_internal" id="page_internal" class="text-input">
													<?php
                                                    echo CHV\Render\get_select_options_html($printInternals, get_page_val('page_internal') ?: null); ?>
												</select></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_internal']; ?></div>
											<div class="input-below"><?php _se('You can have multiple extra pages, but only one of the other special internal types.'); ?></div>
										</div>

										<div class="input-label">
											<label for="page_is_link_visible"><?php _se('Page visibility'); ?></label>
											<div class="c5 phablet-c1"><select type="text" name="page_is_link_visible" id="page_is_link_visible" class="text-input" <?php echo $page_internal_combo_visible ? 'required' : 'data-required'; ?>>
													<?php
                                                    echo CHV\Render\get_select_options_html([1 => _s('Visible page'), 0 => _s('Hidden page')], (int) get_page_val('page_is_link_visible')); ?>
												</select></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_is_link_visible']; ?></div>
											<div class="input-below"><?php _se("Hidden pages won't be show in system menus, but anyone can access to it with the link."); ?></div>
										</div>

										<div class="input-label">
											<label for="page_url_key"><?php _se('URL key'); ?></label>
											<div class="c9 phablet-c1"><input type="text" name="page_url_key" id="page_url_key" class="text-input" value="<?php echo get_page_val('page_url_key'); ?>" pattern="^[\w]([\w-]*[\w])?(\/[\w]([\w-]*[\w])?)*$" rel="tooltip" data-tiptip="right" placeholder="url-key" title="<?php _se('Only alphanumerics, hyphens and forward slash'); ?>" <?php echo $page_internal_combo_visible ? 'required' : 'data-required'; ?>></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_url_key']; ?></div>
											<div class="input-below"><?php echo G\get_base_url('pages/url-key'); ?></div>
										</div>

										<div class="input-label">
											<label for="page_file_path"><?php _se('File path'); ?></label>
											<div class="c9 phablet-c1"><input type="text" name="page_file_path" id="page_file_path" class="text-input" value="<?php echo get_page_val('page_file_path'); ?>" pattern="^[\w]([\w-]*[\w])?(\/[\w]([\w-]*[\w])?)*\.<?php echo G\get_app_setting('disable_php_pages') ? 'html' : 'php'; ?>$" <?php echo $page_internal_combo_visible ? 'required' : 'data-required'; ?> placeholder="page.<?php echo G\get_app_setting('disable_php_pages') ? 'html' : 'php'; ?>"></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_file_path']; ?></div>
											<div class="input-below"><?php
                                                                                                $pages_visible_path = G\absolute_to_relative(CHV_PATH_CONTENT_PAGES);
                                _se('A %f file relative to %s', ['%f' => G\get_app_setting('disable_php_pages') ? 'HTML' : 'PHP', '%s' => $pages_visible_path]); ?></div>
										</div>

										<div class="input-label">
											<label for="page_keywords"><?php _se('Meta keywords'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
											<div class="c9 phablet-c1"><input type="text" name="page_keywords" id="page_keywords" class="text-input" value="<?php echo get_page_val('page_keywords'); ?>"></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_keywords']; ?></div>
										</div>

										<div class="input-label">
											<label for="page_description"><?php _se('Meta description'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
											<div class="c9 phablet-c1"><textarea type="text" name="page_description" id="page_description" class="text-input resize-vertical r2"><?php echo get_page_val('page_description'); ?></textarea></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_description']; ?></div>
										</div>

										<div class="input-label">
											<label for="page_code"><?php _se('Source code'); ?></label>
											<?php
                                            if (get_settings_pages()['doing'] == 'add') {
                                                $page_write_path = CHV\Page::getPath();
                                                $no_write_msg = _s('No write permission in %s path you will need to add this file using an external editor.', $page_write_path);
                                            } else { // edit
                                                $page_write_path = get_page_val('page_file_path_absolute');
                                                if (!get_page_val('page_file_path', 'DB') or !file_exists($page_write_path)) {
                                                    $page_write_path = CHV\Page::getPath();
                                                }
                                                $no_write_msg = _s('No write permission in %s you will need to edit the contents of this file using an external editor.', $page_write_path);
                                            }
                                $is_page_writable = is_writable($page_write_path);
                                $page_path = get_page_val('page_file_path', 'DB');
                                $page_path_absolute = get_page_val('page_file_path_absolute', 'DB'); ?>
											<?php if ($page_path_absolute) {
                                    ?>
												<p class="margin-bottom-10"><?php echo G\absolute_to_relative($page_path ? $page_path_absolute : _s('Taken from: %s', $page_path_absolute)); ?></p>
											<?php
                                } ?>
											<?php if (!$is_page_writable) {
                                    ?>
												<p class="highlight margin-bottom-10 padding-5"><?php echo $no_write_msg; ?></p>
											<?php
                                } ?>
											<textarea type="text" name="page_code" id="page_code" class="text-input resize-vertical r14" <?php if (!$is_page_writable) {
                                    echo ' readonly';
                                } ?>><?php echo (is_readable($page_path_absolute)) ? htmlspecialchars(file_get_contents($page_path_absolute)) : null; ?></textarea>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_code']; ?></div>

										</div>

									</div>

									<div data-combo-value="link" class="switch-combo phablet-c1<?php if (get_page_val('page_type') !== 'link') {
                                    echo ' soft-hidden';
                                } ?>">
										<div class="input-label">
											<label for="page_link_url"><?php _se('Link URL'); ?></label>
											<div class="c9 phablet-c1"><input type="url" name="page_link_url" id="page_link_url" class="text-input" value="<?php echo get_page_val('page_link_url'); ?>" <?php echo get_page_val('page_type') == 'link' ? 'required' : 'data-required'; ?>></div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_link_url']; ?></div>
										</div>
									</div>

								</div>

								<div class="input-label">
									<label for="page_attr_target"><?php _se('Link target attribute'); ?></label>
									<div class="c5 phablet-c1"><select type="text" name="page_attr_target" id="page_attr_target" class="text-input">
											<?php
                                            echo CHV\Render\get_select_options_html(['_self' => '_self', '_blank' => '_blank'], get_page_val('page_attr_target')); ?>
										</select></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_attr_target']; ?></div>
									<div class="input-below"><?php _se('Select %s to open the page or link in a new window.', '"_blank"'); ?></div>
								</div>

								<div class="input-label">
									<label for="page_attr_rel"><?php _se('Link rel attribute'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
									<div class="c9 phablet-c1"><input type="text" name="page_attr_rel" id="page_attr_rel" class="text-input" pattern="[\w\s\-]+" value="<?php echo get_page_val('page_attr_rel'); ?>" rel="tooltip" data-tiptip="right" title="<?php _se('Only alphanumerics, hyphens and whitespaces'); ?>"></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_attr_rel']; ?></div>
									<div class="input-below"><?php _se('HTML &lt;a&gt; %s attribute', '<a href="http://www.w3schools.com/tags/att_a_rel.asp" target="_blank">rel</a>'); ?></div>
								</div>

								<div class="input-label">
									<label for="page_icon"><?php _se('Link icon'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
									<div class="c9 phablet-c1"><input type="text" name="page_icon" id="page_icon" class="text-input" pattern="[\w\s\-]+" value="<?php echo get_page_val('page_icon'); ?>" rel="tooltip" data-tiptip="right" title="<?php _se('Only alphanumerics, hyphens and whitespaces'); ?>"></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_icon']; ?></div>
									<div class="input-below"><?php _se('Check the <a %s>icon reference</a> for the complete list of supported icons.', 'href="http://chevereto.com/src/icomoon" target="_blank"'); ?></div>
								</div>

								<div class="input-label">
									<label for="page_sort_display"><?php _se('Sort order display'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
									<div class="c3 phablet-c1"><input type="number" min="1" name="page_sort_display" id="page_sort_display" class="text-input" value="<?php echo get_page_val('page_sort_display'); ?>"></div>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['page_sort_display']; ?></div>
									<div class="input-below"><?php _se('Page sort order display for menus and listings. Use "1" for top priority.'); ?></div>
								</div>

								<?php
                            } else { // display
                                if (get_pages() and count(get_pages()) > 0) {
                                    $auth_token = G\Handler::getAuthToken(); ?>
									<p><?php echo read_the_docs_settings('pages', _s('pages')); ?></p>
									<ul data-content="dashboard-categories-list" class="tabbed-content-list table-li-hover table-li margin-top-20 margin-bottom-20">
										<li class="table-li-header phone-hide">
											<span class="c2 display-table-cell padding-right-10"><?php echo 'ID'; ?></span>
											<span class="c3 display-table-cell"><?php _se('Type'); ?></span>
											<span class="c5 display-table-cell padding-right-10"><?php _se('URL key'); ?></span>
											<span class="c13 display-table-cell padding-right-10 phablet-hide"><?php _se('Title'); ?></span>
										</li>
										<?php
                                        foreach (get_pages() as $k => $v) {
                                            ?>
											<li>
												<span class="c2 display-table-cell padding-right-10"><?php echo $v['id']; ?></span>
												<span class="c3 display-table-cell padding-right-10 phone-hide"><?php echo $v['type_tr']; ?></span>
												<span class="c5 display-table-cell padding-right-10"><?php echo $v['url_key'] ? G\truncate($v['url_key'], 25) : '--'; ?></span>
												<span class="c13 display-table-cell padding-right-10 phablet-hide"><a href="<?php echo G\get_base_url('dashboard/settings/pages/edit/' . $v['id']); ?>"><?php echo G\truncate($v['title'], 64); ?></a></span>
												<span class="c2 display-table-cell"><a class="delete-link" href="<?php echo G\get_base_url('dashboard/settings/pages/delete/' . $v['id'] . '/?auth_token=' . $auth_token); ?>" data-confirm="<?php _se("Do you really want to delete the page ID %s? This can't be undone.", $v['id']); ?>"><?php _se('Delete'); ?></a></span>
											</li>
										<?php
                                        } // for each page
                                        ?>
									</ul>
								<?php
                                } else { // no pages
                                ?>
									<div class="content-empty">
										<span class="icon icon-drawer"></span>
										<h2><?php _se("There's nothing to show here."); ?></h2>
									</div>
								<?php
                                } ?>

							<?php
                            } // display
                            ?>

						<?php
                        } // pages
                        ?>

						<?php if (get_settings()['key'] == 'image-upload') { ?>
                            <p><?php echo read_the_docs_settings('image-upload', _s('image upload')); ?></p>
                            <div class="input-label">
								<label><?php _se('Enabled image formats'); ?></label>
								<div class="checkbox-label">
									<ul class="c20 phablet-c1">
										<?php
                                        foreach (CHV\Upload::getAvailableImageFormats() as $k) {
                                            echo '<li class="c5 display-inline-block margin-right-10"><label class="display-block" for="image_format_enable[' . $k . ']"> <input type="checkbox" name="image_format_enable[]" id="image_format_enable[' . $k . ']" value="' . $k . '"' . (in_array($k, CHV\Upload::getEnabledImageFormats()) ? ' checked' : null) . '>' . strtoupper($k) . '</label></li>';
                                        } ?>
									</ul>
									<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_enabled_image_formats']; ?></div>
									<p class="margin-top-20"><?php _se("Unchecked image formats won't be allowed to be uploaded."); ?></p>
								</div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="enable_uploads"><?php _se('Enable uploads'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_uploads" id="enable_uploads" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_uploads')); ?>
									</select></div>
								<div class="input-below"><?php _se("Enable this if you want to allow image uploads. This setting doesn't affect administrators."); ?></div>
							</div>
                            <div class="input-label">
								<label for="upload_gui"><?php _se('Upload user interface'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="upload_gui" id="upload_gui" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['js' => _s('On-page container'), 'page' => '/upload ' . _s('route')], CHV\Settings::get('upload_gui')); ?>
									</select></div>
							</div>
							<div class="input-label">
								<label for="guest_uploads"><?php _se('Guest uploads'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="guest_uploads" id="guest_uploads" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                                            echo ' disabled';
                                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('guest_uploads')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to allow non registered users to upload.'); ?></div>
								<?php personal_mode_warning(); ?>
							</div>
                            <div class="input-label">
								<label for="moderate_uploads"><?php _se('Moderate uploads'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="moderate_uploads" id="moderate_uploads" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                                            echo ' disabled';
                                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([
                                                '' => _s('Disabled'),
                                                'guest' => _s('Guest'),
                                                'all' => _s('All')
                                            ], CHV\Settings::get('moderate_uploads')); ?>
									</select></div>
                                <div class="input-below"><?php _se('Enable this to moderate incoming uploads. Target content will require moderation for approval.'); ?></div>
								<?php personal_mode_warning(); ?>
							</div>

                            <hr class="line-separator">

							<div class="input-label">
								<label for="theme_show_embed_uploader"><?php _se('Enable embed codes (uploader)'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_show_embed_uploader" id="theme_show_embed_uploader" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_show_embed_uploader')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to show embed codes when upload gets completed.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="upload_threads"><?php _se('Upload threads'); ?></label>
								<div class="c2"><input type="number" min="1" max="5" pattern="\d+" name="upload_threads" id="upload_threads" class="text-input" value="<?php echo CHV\Settings::get('upload_threads'); ?>" placeholder="2" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_threads']; ?></div>
								<div class="input-below"><?php _se('Number of simultaneous upload threads (parallel uploads)'); ?></div>
							</div>

							<div class="input-label">
								<label for="enable_redirect_single_upload"><?php _se('Redirect on single upload'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_redirect_single_upload" id="enable_redirect_single_upload" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_redirect_single_upload')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to redirect to image page on single upload.'); ?></div>
							</div>

							<div class="input-label">
								<label for="enable_duplicate_uploads"><?php _se('Enable duplicate uploads'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_duplicate_uploads" id="enable_duplicate_uploads" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_duplicate_uploads')); ?>
									</select></div>
								<div class="input-below"><?php _se("Enable this if you want to allow duplicate uploads from the same IP within 24hrs. This setting doesn't affect administrators."); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="enable_expirable_uploads"><?php _se('Enable expirable uploads'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_expirable_uploads" id="enable_expirable_uploads" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_expirable_uploads')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to allow uploads with an automatic delete option.'); ?></div>
							</div>

							<div class="input-label">
								<label for="auto_delete_guest_uploads"><?php _se('Auto delete guest uploads'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="auto_delete_guest_uploads" id="auto_delete_guest_uploads" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(CHV\Image::getAvailableExpirations(), CHV\Settings::get('auto_delete_guest_uploads')); ?>
									</select></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['auto_delete_guest_uploads']; ?></div>
								<div class="input-below"><?php _se('Enable this if you want to force guest uploads to be auto deleted after certain time.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="upload_max_image_width" class="display-block-forced"><?php _se('Maximum image size'); ?></label>
								<div class="c5 overflow-auto clear-both">
									<div class="c2 float-left">
										<input type="number" min="0" pattern="\d+" name="upload_max_image_width" id="upload_max_image_width" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_max_image_width'] : CHV\Settings::get('upload_max_image_width'); ?>" placeholder="<?php echo  CHV\Settings::getDefault('upload_max_image_width'); ?>" rel="tooltip" data-tiptip="top" title="<?php _se('Width'); ?>" required>
									</div>
									<div class="c2 float-left margin-left-10">
										<input type="number" min="0" pattern="\d+" name="upload_max_image_height" id="upload_max_image_height" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_max_image_height'] : CHV\Settings::get('upload_max_image_height'); ?>" placeholder="<?php echo  CHV\Settings::getDefault('upload_max_image_height'); ?>" rel="tooltip" data-tiptip="top" title="<?php _se('Height'); ?>" required>
									</div>
								</div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_max_image_width']; ?></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_max_image_height']; ?></div>
								<div class="input-below"><?php _se("Images greater than this size will get automatically downsized. Use zero (0) to don't set a limit."); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="upload_image_exif"><?php _se('Image Exif data'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="upload_image_exif" id="upload_image_exif" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([
                                            1 => _s('Keep'),
                                            0 => _s('Remove'),
                                        ], CHV\Settings::get('upload_image_exif')); ?>
									</select></div>
								<div class="input-below"><?php _se('Select the default setting for image <a %s>Exif data</a> on upload.', 'href="https://en.wikipedia.org/wiki/Exchangeable_image_file_format" target="_blank"'); ?></div>
							</div>

							<div class="input-label">
								<label for="upload_image_exif_user_setting"><?php _se('Image Exif data (user setting)'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="upload_image_exif_user_setting" id="upload_image_exif_user_setting" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([
                                            1 => _s('Enabled'),
                                            0 => _s('Disabled'),
                                        ], CHV\Settings::get('upload_image_exif_user_setting')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to allow each user to configure how image Exif data will be handled.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="upload_max_filesize_mb"><?php _se('Maximum upload file size'); ?> [MB]</label>
								<div class="c2"><input type="number" min="0.1" step="0.1" max="<?php echo G\bytes_to_mb(CHV\Settings::get('true_upload_max_filesize')); ?>" pattern="\d+" name="upload_max_filesize_mb" id="upload_max_filesize_mb" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_max_filesize_mb'] : CHV\Settings::get('upload_max_filesize_mb'); ?>" placeholder="MB" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_max_filesize_mb']; ?></div>
								<div class="input-below"><?php _se('Maximum size allowed by server is %s. This limit is capped by %u and %p (%f values).', ['%s' => G\format_bytes(CHV\Settings::get('true_upload_max_filesize')), '%u' => '<code>upload_max_filesize = ' . ini_get('upload_max_filesize') . '</code>', '%p' => '<code>post_max_size = ' . ini_get('post_max_size') . '</code>', '%f' => 'php.ini']); ?></div>
							</div>

							<div class="input-label">
								<label for="upload_max_filesize_mb_guest"><?php _se('Maximum upload file size'); ?> (<?php _se('guests'); ?>)</label>
								<div class="c2"><input type="number" min="0.1" step="0.1" max="<?php echo G\bytes_to_mb(CHV\Settings::get('true_upload_max_filesize')); ?>" pattern="\d+" name="upload_max_filesize_mb_guest" id="upload_max_filesize_mb_guest" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_max_filesize_mb_guest'] : CHV\Settings::get('upload_max_filesize_mb_guest'); ?>" placeholder="MB" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_max_filesize_mb_guest']; ?></div>
								<div class="input-below"><?php _se('Same as "%s" but for guests.', _s('Maximum upload file size')); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="upload_image_path"><?php _se('Image path'); ?></label>
								<div class="c9 phablet-c1"><input type="text" name="upload_image_path" id="upload_image_path" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_image_path'] : CHV\Settings::get('upload_image_path'); ?>" placeholder="<?php _se('Relative to Chevereto root'); ?>" required></div>
								<span class="input-warning red-warning"><?php echo get_input_errors()['upload_image_path']; ?></span>
								<div class="input-below"><?php _se('Where to store the images? Relative to Chevereto root.'); ?></div>
							</div>
							<div class="input-label">
								<label for="upload_storage_mode"><?php _se('Storage mode'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="upload_storage_mode" id="upload_storage_mode" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['datefolder' => _s('Datefolders'), 'direct' => _s('Direct')], CHV\Settings::get('upload_storage_mode')); ?>
									</select></div>
								<div class="input-below"><?php _se('Datefolders creates %s structure', date('/Y/m/d/')); ?></div>
							</div>
							<div class="input-label">
								<label for="upload_filenaming"><?php _se('File naming method'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="upload_filenaming" id="upload_filenaming" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['original' => _s('Original'), 'random' => _s('Random'), 'mixed' => _s('Mix original + random'), 'id' => 'ID'], CHV\Settings::get('upload_filenaming')); ?>
									</select></div>
								<div class="input-below"><?php _se('"Original" will try to keep the image source name while "Random" will generate a random name. "ID" will name the image just like the image ID.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="upload_thumb_width" class="display-block-forced"><?php _se('Thumb size'); ?></label>
								<div class="c5 overflow-auto clear-both">
									<div class="c2 float-left">
										<input type="number" min="16" pattern="\d+" name="upload_thumb_width" id="upload_thumb_width" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_thumb_width'] : CHV\Settings::get('upload_thumb_width'); ?>" placeholder="<?php echo  CHV\Settings::getDefault('upload_thumb_width'); ?>" rel="tooltip" data-tiptip="top" title="<?php _se('Width'); ?>" required>
									</div>
									<div class="c2 float-left margin-left-10">
										<input type="number" min="16" pattern="\d+" name="upload_thumb_height" id="upload_thumb_height" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_thumb_height'] : CHV\Settings::get('upload_thumb_height'); ?>" placeholder="<?php echo  CHV\Settings::getDefault('upload_thumb_height'); ?>" rel="tooltip" data-tiptip="top" title="<?php _se('Height'); ?>" required>
									</div>
								</div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_thumb_width']; ?></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_thumb_height']; ?></div>
								<div class="input-below"><?php _se('Thumbnails will be fixed to this size.'); ?></div>
							</div>
							<div class="input-label">
								<label for="upload_medium_fixed_dimension"><?php _se('Medium image fixed dimension'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="upload_medium_fixed_dimension" id="upload_medium_fixed_dimension" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['width' => _s('Width'), 'height' => _s('Height')], CHV\Settings::get('upload_medium_fixed_dimension')); ?>
									</select></div>
								<div class="input-below"><?php _se('Medium sized images will be fixed to this dimension. For example, if you select "width" that dimension will be fixed and image height will be automatically calculated.'); ?></div>
							</div>
							<div class="input-label">
								<label for="upload_medium_size"><?php _se('Medium image fixed size'); ?></label>
								<div class="c2">
									<input type="number" min="16" pattern="\d+" name="upload_medium_size" id="upload_medium_size" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['upload_medium_size'] : CHV\Settings::get('upload_medium_size'); ?>" placeholder="<?php echo CHV\Settings::getDefault('upload_medium_size'); ?>" required>
								</div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['upload_medium_size']; ?></div>
								<div class="input-below"><?php _se('Width or height will be automatically calculated.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="watermark_enable"><?php _se('Watermarks'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="watermark_enable" id="watermark_enable" class="text-input" data-combo="watermark-combo">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['watermark_enable'] : CHV\Settings::get('watermark_enable')); ?>
									</select></div>
								<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['watermark_enable']; ?></div>
								<div class="input-below"><?php _se('Enable this to put a logo or anything you want in image uploads.'); ?></div>
							</div>
							<div id="watermark-combo">
								<div data-combo-value="1" class="switch-combo phablet-c1<?php if ((get_safe_post() ? get_safe_post()['watermark_enable'] : CHV\Settings::get('watermark_enable')) != 1) {
                                            echo ' soft-hidden';
                                        } ?>">
									<?php
                                    if (!is_writable(CHV_PATH_CONTENT_IMAGES_SYSTEM)) {
                                        ?>
										<p class="highlight"><?php _se("Warning: Can't write in %s", CHV_PATH_CONTENT_IMAGES_SYSTEM); ?></p>
									<?php
                                    } ?>

									<div class="input-label">
										<label for="watermark_checkboxes"><?php _se('Watermark user toggles'); ?></label>
										<?php echo CHV\Render\get_checkbox_html([
                                            'name' => 'watermark_enable_guest',
                                            'label' => _s('Enable watermark on guest uploads'),
                                            'checked' => ((bool) (get_safe_post() ? get_safe_post()['watermark_enable_guest'] : CHV\Settings::get('watermark_enable_guest'))),
                                        ]); ?>
										<?php echo CHV\Render\get_checkbox_html([
                                            'name' => 'watermark_enable_user',
                                            'label' => _s('Enable watermark on user uploads'),
                                            'checked' => ((bool) (get_safe_post() ? get_safe_post()['watermark_enable_user'] : CHV\Settings::get('watermark_enable_user'))),
                                        ]); ?>
										<?php echo CHV\Render\get_checkbox_html([
                                            'name' => 'watermark_enable_admin',
                                            'label' => _s('Enable watermark on admin uploads'),
                                            'checked' => ((bool) (get_safe_post() ? get_safe_post()['watermark_enable_admin'] : CHV\Settings::get('watermark_enable_admin'))),
                                        ]); ?>
									</div>

									<div class="input-label">
										<label for="watermark_checkboxes"><?php _se('Watermark file toggles'); ?></label>
										<?php echo CHV\Render\get_checkbox_html([
                                            'name' => 'watermark_enable_file_gif',
                                            'label' => _s('Enable watermark on GIF image uploads'),
                                            'checked' => ((bool) (get_safe_post() ? get_safe_post()['watermark_enable_file_gif'] : CHV\Settings::get('watermark_enable_file_gif'))),
                                        ]); ?>
									</div>

									<div class="input-label">
										<label for="watermark_target_min_width" class="display-block-forced"><?php _se('Minimum image size needed to apply watermark'); ?></label>
										<div class="c5 overflow-auto clear-both">
											<div class="c2 float-left">
												<input type="number" min="0" pattern="\d+" name="watermark_target_min_width" id="watermark_target_min_width" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['watermark_target_min_width'] : CHV\Settings::get('watermark_target_min_width'); ?>" placeholder="<?php echo  CHV\Settings::getDefault('watermark_target_min_width'); ?>" rel="tooltip" data-tiptip="top" title="<?php _se('Width'); ?>" required>
											</div>
											<div class="c2 float-left margin-left-10">
												<input type="number" min="0" pattern="\d+" name="watermark_target_min_height" id="watermark_target_min_height" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['watermark_target_min_height'] : CHV\Settings::get('watermark_target_min_height'); ?>" placeholder="<?php echo  CHV\Settings::getDefault('watermark_target_min_height'); ?>" rel="tooltip" data-tiptip="top" title="<?php _se('Height'); ?>" required>
											</div>
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['watermark_target_min_width']; ?></div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['watermark_target_min_height']; ?></div>
										<div class="input-below"><?php _se("Images smaller than this won't be watermarked. Use zero (0) to don't set a minimum image size limit."); ?></div>
									</div>

									<div class="input-label">
										<label for="watermark_image"><?php _se('Watermark image'); ?></label>
										<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('watermark_image')) . '?' . G\random_string(8); ?>"></div>
										<div class="c5 phablet-c1">
											<input id="watermark_image" name="watermark_image" type="file" accept="image/png">
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['watermark_image']; ?></div>
										<div class="input-below"><?php _se('You will get best results with plain logos with drop shadow. You can use a large image if the file size is not that big (recommended max. is 16KB). Must be a PNG.'); ?></div>
									</div>
									<div class="input-label">
										<label for="watermark_position"><?php _se('Watermark position'); ?></label>
										<div class="c5 phablet-c1"><select type="text" name="watermark_position" id="watermark_position" class="text-input">
												<?php
                                                echo CHV\Render\get_select_options_html([
                                                    'left top' => _s('left top'),
                                                    'left center' => _s('left center'),
                                                    'left bottom' => _s('left bottom'),
                                                    'center top' => _s('center top'),
                                                    'center center' => _s('center center'),
                                                    'center bottom' => _s('center bottom'),
                                                    'right top' => _s('right top'),
                                                    'right center' => _s('right center'),
                                                    'right bottom' => _s('right bottom'),
                                                ], get_safe_post() ? get_safe_post()['watermark_position'] : CHV\Settings::get('watermark_position')); ?>
											</select></div>
										<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['watermark_position']; ?></div>
										<div class="input-below"><?php _se('Relative position of the watermark image. First horizontal align then vertical align.'); ?></div>
									</div>
									<div class="input-label">
										<label for="watermark_percentage"><?php _se('Watermark percentage'); ?></label>
										<div class="c2">
											<input type="number" min="1" max="100" pattern="\d+" name="watermark_percentage" id="watermark_percentage" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['watermark_percentage'] : CHV\Settings::get('watermark_percentage'); ?>" placeholder="<?php echo CHV\Settings::getDefault('watermark_percentage'); ?>" required>
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['watermark_percentage']; ?></div>
										<div class="input-below"><?php _se('Watermark percentual size relative to the target image area. Values 1 to 100.'); ?></div>
									</div>
									<div class="input-label">
										<label for="watermark_margin"><?php _se('Watermark margin'); ?></label>
										<div class="c2">
											<input type="number" min="0" pattern="\d+" name="watermark_margin" id="watermark_margin" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['watermark_margin'] : CHV\Settings::get('watermark_margin'); ?>" placeholder="<?php echo CHV\Settings::getDefault('watermark_margin'); ?>" required>
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['watermark_margin']; ?></div>
										<div class="input-below"><?php _se('Margin from the border of the image to the watermark image.'); ?></div>
									</div>
									<div class="input-label">
										<label for="watermark_opacity"><?php _se('Watermark opacity'); ?></label>
										<div class="c2">
											<input type="number" min="1" max="100" pattern="\d+" name="watermark_opacity" id="watermark_opacity" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['watermark_opacity'] : CHV\Settings::get('watermark_opacity'); ?>" placeholder="<?php echo CHV\Settings::getDefault('watermark_opacity'); ?>" required>
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['watermark_opacity']; ?></div>
										<div class="input-below"><?php _se('Opacity of the watermark in the final watermarked image. Values 0 to 100.'); ?></div>
									</div>
								</div>
							</div>

						<?php
                        } ?>

                        <?php if (get_settings()['key'] == 'categories') { ?>
                            <p><?php echo read_the_docs_settings('categories', _s('categories')); ?></p>
							<?php if (!CHV\getSetting('website_explore_page')) {
                            ?>
								<div class="growl static"><?php _se("Categories won't work when the explorer feature is turned off. To revert this setting go to %s.", ['%s' => '<a href="' . G\get_base_url('dashboard/settings/website') . '">' . _s('Dashboard > Settings > Website') . '</a>']); ?></div>
							<?php
                        } ?>
							<script>
								$(document).ready(function() {
									CHV.obj.categories = <?php echo json_encode(get_categories()); ?>;
								});
							</script>
							<ul data-content="dashboard-categories-list" class="tabbed-content-list table-li-hover table-li margin-top-20 margin-bottom-20">
								<li class="table-li-header phone-hide">
									<span class="c5 display-table-cell padding-right-10"><?php _se('Name'); ?></span>
									<span class="c4 display-table-cell padding-right-10 phone-hide phablet-hide"><?php _se('URL key'); ?></span>
									<span class="c13 display-table-cell phone-hide"><?php _se('Description'); ?></span>
								</li>
								<?php
                                $li_template = '<li data-content="category" data-category-id="%ID%">
					<span class="c5 display-table-cell padding-right-10"><a data-modal="edit" data-target="form-modal" data-category-id="%ID%" data-content="category-name">%NAME%</a></span>
					<span class="c4 display-table-cell padding-right-10 phone-hide phablet-hide" data-content="category-url_key">%URL_KEY%</span>
					<span class="c13 display-table-cell padding-right-10 phone-display-block" data-content="category-description">%DESCRIPTION%</span>
					<span class="c2 display-table-cell"><a class="delete-link" data-category-id="%ID%" data-args="%ID%" data-confirm="' . _s("Do you really want to delete the %s category? This can't be undone.") . '" data-submit-fn="CHV.fn.category.delete.submit" data-before-fn="CHV.fn.category.delete.before" data-ajax-deferred="CHV.fn.category.delete.complete">' . _s('Delete') . '</a></span>
				</li>';
                            if (get_categories()) {
                                foreach (get_categories() as $category) {
                                    $replaces = [];
                                    foreach ($category as $k => $v) {
                                        $replaces['%' . strtoupper($k) . '%'] = $v;
                                    }
                                    echo strtr($li_template, $replaces);
                                }
                            } ?>
							</ul>
							<div class="hidden" data-content="category-dashboard-template">
								<?php echo $li_template; ?>
							</div>
							<p><?php _se("Note: Deleting a category doesn't delete the images that belongs to that category."); ?></p>
							<div data-modal="form-modal" class="hidden" data-submit-fn="CHV.fn.category.edit.submit" data-before-fn="CHV.fn.category.edit.before" data-ajax-deferred="CHV.fn.category.edit.complete" data-ajax-url="<?php echo G\get_base_url('json'); ?>">
								<span class="modal-box-title"><?php _se('Edit category'); ?></span>
								<div class="modal-form">
									<input type="hidden" name="form-category-id">
									<?php G\Render\include_theme_file('snippets/form_category_edit'); ?>
								</div>
							</div>
						<?php
                        } ?>
						<?php
                        if (get_settings()['key'] == 'ip-bans') {
                            try {
                                $ip_bans = CHV\Ip_ban::getAll();
                            } catch (Exception $e) {
                                G\exception_to_error($e);
                            } ?>
							<script>
								$(document).ready(function() {
									CHV.obj.ip_bans = <?php echo json_encode($ip_bans); ?>;
								});
                            </script>
                            <p><?php echo read_the_docs_settings('ip-bans', _s('ip bans')); ?></p>
							<ul data-content="dashboard-ip_bans-list" class="tabbed-content-list table-li table-li-hover margin-top-20 margin-bottom-20">
								<li class="table-li-header phone-hide">
									<span class="c6 display-table-cell padding-right-10">IP</span>
									<span class="c5 display-table-cell padding-right-10 phone-hide phablet-hide"><?php _se('Expires'); ?></span>
									<span class="c13 display-table-cell phone-hide"><?php _se('Message'); ?></span>
								</li>
								<?php
                                $li_template = '<li data-content="ip_ban" data-ip_ban-id="%ID%" class="word-break-break-all">
					<span class="c6 display-table-cell padding-right-10"><a data-modal="edit" data-target="form-modal" data-ip_ban-id="%ID%" data-content="ip_ban-ip">%IP%</a></span>
					<span class="c5 display-table-cell padding-right-10 phone-hide phablet-hide" data-content="ip_ban-expires">%EXPIRES%</span>
					<span class="c14 display-table-cell padding-right-10 phone-display-block" data-content="ip_ban-message">%MESSAGE%</span>
					<span class="c2 display-table-cell"><a class="delete-link" data-ip_ban-id="%ID%" data-args="%ID%" data-confirm="' . _s("Do you really want to remove the ban to the IP %s? This can't be undone.") . '" data-submit-fn="CHV.fn.ip_ban.delete.submit" data-before-fn="CHV.fn.ip_ban.delete.before" data-ajax-deferred="CHV.fn.ip_ban.delete.complete">' . _s('Delete') . '</a></span>
				</li>';
                            foreach ($ip_bans as $ip_ban) {
                                $replaces = [];
                                foreach ($ip_ban as $k => $v) {
                                    $replaces['%' . strtoupper($k) . '%'] = $v;
                                }
                                echo strtr($li_template, $replaces);
                            } ?>
							</ul>
							<div class="hidden" data-content="ip_ban-dashboard-template">
								<?php echo $li_template; ?>
							</div>
							<p><?php _se('Banned IP address will be forbidden to use the entire website.'); ?></p>
							<div data-modal="form-modal" class="hidden" data-submit-fn="CHV.fn.ip_ban.edit.submit" data-before-fn="CHV.fn.ip_ban.edit.before" data-ajax-deferred="CHV.fn.ip_ban.edit.complete" data-ajax-url="<?php echo G\get_base_url('json'); ?>">
								<span class="modal-box-title"><?php _se('Edit IP ban'); ?></span>
								<div class="modal-form">
									<input type="hidden" name="form-ip_ban-id">
									<?php G\Render\include_theme_file('snippets/form_ip_ban_edit'); ?>
								</div>
							</div>
						<?php
                        } ?>

						<?php if (get_settings()['key'] == 'users') { ?>
                            <p><?php echo read_the_docs_settings('users', _s('users')); ?></p>
                            <div class="input-label">
								<label for="enable_signups"><?php _se('Enable signups'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_signups" id="enable_signups" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                            echo ' disabled';
                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_signups')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to allow users to signup.'); ?></div>
								<?php personal_mode_warning(); ?>
							</div>

							<div class="input-label">
								<label for="enable_user_content_delete"><?php _se('Enable user content delete'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_user_content_delete" id="enable_user_content_delete" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_user_content_delete')); ?>
									</select></div>
								<div class="input-below"><?php _se("Enable this if you want to allow users to delete their own content. This setting doesn't affect administrators."); ?></div>
								<?php personal_mode_warning(); ?>
							</div>

							<div class="input-label">
								<label for="user_minimum_age"><?php _se('Minimum age required'); ?></label>
								<div class="c3"><input type="number" min="0" pattern="\d+" name="user_minimum_age" id="user_minimum_age" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                                            echo ' disabled';
                                        } ?> value="<?php echo get_safe_post() ? get_safe_post()['user_minimum_age'] : CHV\Settings::get('user_minimum_age'); ?>" placeholder="<?php _se('Empty'); ?>"></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['user_minimum_age']; ?></div>
								<div class="input-below"><?php _se("Leave it empty to don't require a minimum age to use the website."); ?></div>
								<?php personal_mode_warning(); ?>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="notify_user_signups"><?php _se('Notify on user signup'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="notify_user_signups" id="notify_user_signups" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('notify_user_signups')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to get an email notification for each new user signup.'); ?></div>
							</div>


							<div class="input-label">
								<label for="user_routing"><?php _se('Username routing'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="user_routing" id="user_routing" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                                            echo ' disabled';
                                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('user_routing')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to use %s/username URLs instead of %s/user/username.', ['%s' => rtrim(G\get_base_url(), '/')]); ?></div>
								<?php personal_mode_warning(); ?>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="require_user_email_confirmation"><?php _se('Require email confirmation'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="require_user_email_confirmation" id="require_user_email_confirmation" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                                            echo ' disabled';
                                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('require_user_email_confirmation')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if users must validate their email address on sign up.'); ?></div>
								<?php personal_mode_warning(); ?>
							</div>
							<div class="input-label">
								<label for="require_user_email_social_signup"><?php _se('Require email for social signup'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="require_user_email_social_signup" id="require_user_email_social_signup" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                                            echo ' disabled';
                                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('require_user_email_social_signup')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if users using social networks to register must provide an email address.'); ?></div>
								<?php personal_mode_warning(); ?>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="user_image_avatar_max_filesize_mb"><?php _se('User avatar max. filesize'); ?> (MB)</label>
								<div class="c3"><input type="number" min="0" pattern="\d+" name="user_image_avatar_max_filesize_mb" id="user_image_avatar_max_filesize_mb" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['user_image_avatar_max_filesize_mb'] : CHV\Settings::get('user_image_avatar_max_filesize_mb'); ?>" placeholder="MB" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['user_image_avatar_max_filesize_mb']; ?></div>
								<div class="input-below"><?php _se('Max. allowed filesize for user avatar image. (Max allowed by server is %s)', G\format_bytes(G\get_ini_bytes(ini_get('upload_max_filesize'))), 'strtr'); ?></div>
							</div>
							<div class="input-label">
								<label for="user_image_background_max_filesize_mb"><?php _se('User background max. filesize'); ?> (MB)</label>
								<div class="c3"><input type="number" min="0" pattern="\d+" name="user_image_background_max_filesize_mb" id="user_image_background_max_filesize_mb" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['user_image_background_max_filesize_mb'] : CHV\Settings::get('user_image_background_max_filesize_mb'); ?>" placeholder="MB" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['user_image_background_max_filesize_mb']; ?></div>
								<div class="input-below"><?php _se('Max. allowed filesize for user background image. (Max allowed by server is %s)', G\format_bytes(G\get_ini_bytes(ini_get('upload_max_filesize'))), 'strtr'); ?></div>
							</div>

						<?php
                        } ?>

						<?php if (get_settings()['key'] == 'consent-screen') {
                            ?>
							<p><?php _se("Shows a consent screen before accessing the website. Useful for adult content websites where minors shouldn't be allowed."); ?> <?php echo read_the_docs_settings('consent-screen', _s('consent screen')); ?></p>
							<div class="input-label">
								<label for="enable_consent_screen"><?php _se('Enable consent screen'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="enable_consent_screen" id="enable_consent_screen" class="text-input" data-combo="consent-screen-combo">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['enable_consent_screen'] : CHV\Settings::get('enable_consent_screen')); ?>
									</select></div>
							</div>
							<div id="consent-screen-combo">
								<div data-combo-value="1" class="switch-combo <?php if (!(get_safe_post() ? get_safe_post()['enable_consent_screen'] : CHV\Settings::get('enable_consent_screen'))) {
                                            echo ' soft-hidden';
                                        } ?>">
									<div class="input-label">
										<label for="consent_screen_cover_image"><?php _se('Consent screen cover image'); ?></label>
										<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('consent_screen_cover_image')); ?>"></div>
										<div class="c5 phablet-c1">
											<input id="consent_screen_cover_image" name="consent_screen_cover_image" type="file" accept="image/*">
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['consent_screen_cover_image']; ?></div>
									</div>
								</div>
							</div>
						<?php
                        } ?>

						<?php if (get_settings()['key'] == 'flood-protection') {
                            ?>
							<p><?php _se("Block image uploads by IP if the system notice a flood  behavior based on the number of uploads per time period. This setting doesn't affect administrators."); ?> <?php echo read_the_docs_settings('flood-protection', _s('flood protection')); ?></p>
							<div class="input-label">
								<label for="flood_uploads_protection"><?php _se('Flood protection'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="flood_uploads_protection" id="flood_uploads_protection" class="text-input" data-combo="flood-protection-combo">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['flood_uploads_protection'] : CHV\Settings::get('flood_uploads_protection')); ?>
									</select></div>
							</div>
							<div id="flood-protection-combo">
								<div data-combo-value="1" class="switch-combo <?php if (!(get_safe_post() ? get_safe_post()['flood_uploads_protection'] : CHV\Settings::get('flood_uploads_protection'))) {
                                            echo ' soft-hidden';
                                        } ?>">
									<div class="input-label">
										<label for="flood_uploads_notify"><?php _se('Notify to email'); ?></label>
										<div class="c5 phablet-c1"><select type="text" name="flood_uploads_notify" id="flood_uploads_notify" class="text-input">
												<?php
                                                echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['flood_uploads_notify'] : CHV\Settings::get('flood_uploads_notify')); ?>
											</select></div>
										<div class="input-below"><?php _se('If enabled the system will send an email on flood incidents.'); ?></div>
									</div>
									<div class="input-label">
										<label for="flood_uploads_minute"><?php _se('Minute limit'); ?></label>
										<div class="c3"><input type="number" min="0" name="flood_uploads_minute" id="flood_uploads_minute" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['flood_uploads_minute'] : CHV\Settings::get('flood_uploads_minute', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('flood_uploads_minute'); ?>"></div>
										<div class="input-warning red-warning"><?php echo get_input_errors()['flood_uploads_minute']; ?></div>
									</div>
									<div class="input-label">
										<label for="flood_uploads_hour"><?php _se('Hourly limit'); ?></label>
										<div class="c3"><input type="number" min="0" name="flood_uploads_hour" id="flood_uploads_hour" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['flood_uploads_hour'] : CHV\Settings::get('flood_uploads_hour', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('flood_uploads_hour'); ?>"></div>
										<div class="input-warning red-warning"><?php echo get_input_errors()['flood_uploads_hour']; ?></div>
									</div>
									<div class="input-label">
										<label for="flood_uploads_day"><?php _se('Daily limit'); ?></label>
										<div class="c3"><input type="number" min="0" name="flood_uploads_day" id="flood_uploads_day" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['flood_uploads_day'] : CHV\Settings::get('flood_uploads_day', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('flood_uploads_day'); ?>"></div>
										<div class="input-warning red-warning"><?php echo get_input_errors()['flood_uploads_day']; ?></div>
									</div>
									<div class="input-label">
										<label for="flood_uploads_week"><?php _se('Weekly limit'); ?></label>
										<div class="c3"><input type="number" min="0" name="flood_uploads_week" id="flood_uploads_week" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['flood_uploads_week'] : CHV\Settings::get('flood_uploads_week', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('flood_uploads_week'); ?>"></div>
										<div class="input-warning red-warning"><?php echo get_input_errors()['flood_uploads_week']; ?></div>
									</div>
									<div class="input-label">
										<label for="flood_uploads_month"><?php _se('Monthly limit'); ?></label>
										<div class="c3"><input type="number" min="0" name="flood_uploads_month" id="flood_uploads_month" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['flood_uploads_month'] : CHV\Settings::get('flood_uploads_month', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('flood_uploads_month'); ?>"></div>
										<div class="input-warning red-warning"><?php echo get_input_errors()['flood_uploads_month']; ?></div>
									</div>
								</div>
							</div>
						<?php
                        } ?>

						<?php if (get_settings()['key'] == 'content') { ?>
                            <p><?php echo read_the_docs_settings('content', _s('content')); ?></p>
                            <div class="input-label">
								<label for="image_lock_nsfw_editing"><?php _se('Lock %s editing', _s('NSFW')); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="image_lock_nsfw_editing" id="image_lock_nsfw_editing" class="text-input" <?php if (CHV\getSetting('website_mode') == 'personal') {
                            echo ' disabled';
                        } ?>>
										<?php
                                        echo CHV\Render\get_select_options_html([
                                                0 => _s('Disabled'),
                                                1 => _s('Enabled'),
                                            ], CHV\Settings::get('image_lock_nsfw_editing')); ?>
									</select></div>
                                <div class="input-below"><?php _se('Enable this to prevent users from changing the NSFW flag. When enabled, only admin and managers will have this permission.'); ?></div>
								<?php personal_mode_warning(); ?>
							</div>
							<div class="input-label">
								<label for="show_nsfw_in_listings"><?php _se('Show not safe content in listings'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="show_nsfw_in_listings" id="show_nsfw_in_listings" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('show_nsfw_in_listings')); ?>
									</select></div>
								<div class="input-below"><?php _se("Enable this if you want to show not safe content in listings. This setting doesn't affect administrators and can be overridden by user own settings."); ?></div>
							</div>
							<div class="input-label">
								<label for="theme_nsfw_blur"><?php _se('Blur NSFW content in listings'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_nsfw_blur" id="theme_nsfw_blur" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_nsfw_blur')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to apply a blur effect on the NSFW images in listings.'); ?></div>
							</div>

							<div class="input-label">
								<label for="show_nsfw_in_random_mode"><?php _se('Show not safe content in random mode'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="show_nsfw_in_random_mode" id="show_nsfw_in_random_mode" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['show_nsfw_in_random_mode'] : CHV\Settings::get('show_nsfw_in_random_mode')); ?>
									</select></div>
							</div>
						<?php
                        } ?>

                        <?php if (get_settings()['key'] == 'listings') { ?>
                            <p><?php echo read_the_docs_settings('listings', _s('listings')); ?></p>
							<div class="input-label">
								<label for="listing_items_per_page"><?php _se('List items per page'); ?></label>
								<div class="c2"><input type="number" min="1" name="listing_items_per_page" id="listing_items_per_page" class="text-input" value="<?php echo CHV\Settings::get('listing_items_per_page', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('listing_items_per_page', true); ?>" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['listing_items_per_page']; ?></div>
								<div class="input-below"><?php _se('How many items should be displayed per page listing.'); ?></div>
							</div>

							<div class="input-label">
								<label for="listing_pagination_mode"><?php _se('List pagination mode'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="listing_pagination_mode" id="listing_pagination_mode" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['endless' => _s('Endless scrolling'), 'classic' => _s('Classic pagination')], CHV\Settings::get('listing_pagination_mode')); ?>
									</select></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['listing_pagination_mode']; ?></div>
								<div class="input-below"><?php _se('What pagination method should be used.'); ?></div>
							</div>

							<div class="input-label">
								<label for="listing_viewer"><?php _se('Listing viewer'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="listing_viewer" id="listing_viewer" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['listing_viewer'] : CHV\Settings::get('listing_viewer')); ?>
									</select></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['listing_viewer']; ?></div>
								<div class="input-below"><?php _se('Enable this to use the listing viewer when clicking on an image.'); ?></div>
							</div>

							<div class="input-label">
								<label for="theme_image_listing_sizing"><?php _se('Image listing size'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_image_listing_sizing" id="theme_image_listing_sizing" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['fluid' => _s('Fluid'), 'fixed' => _s('Fixed')], get_safe_post() ? get_safe_post()['theme_image_listing_sizing'] : CHV\Settings::get('theme_image_listing_sizing'), CHV\Settings::get('theme_image_listing_sizing')); ?>
									</select></div>
								<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['theme_image_listing_sizing']; ?></div>
								<div class="input-below"><?php _se('Both methods use a fixed width but fluid method uses automatic heights.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="explore_albums_min_image_count"><?php _se('Album listing images requirement'); ?> (<?php echo _se('explore'); ?>)</label>
								<div class="c2"><input type="number" min="1" name="explore_albums_min_image_count" id="explore_albums_min_image_count" class="text-input" value="<?php echo CHV\Settings::get('explore_albums_min_image_count', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('explore_albums_min_image_count', true); ?>" required></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['explore_albums_min_image_count']; ?></div>
								<div class="input-below"><?php _se('Sets the minimum image count needed to show albums in explore.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label><?php _se('Listing columns number'); ?></label>
								<div class="input-below"><?php _se('Here you can set how many columns are used based on each target device.'); ?></div>
								<div class="overflow-auto margin-bottom-10 margin-top-10">
									<label for="listing_columns_phone" class="c2 float-left input-line-height"><?php _se('Phone'); ?></label>
									<input type="number" name="listing_columns_phone" id="listing_columns_phone" class="text-input c2" value="<?php echo CHV\Settings::get('listing_columns_phone', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('listing_columns_phone', true); ?>" pattern="\d*" min="1" max="7" required>
								</div>
								<div class="overflow-auto margin-bottom-10">
									<label for="listing_columns_phablet" class="c2 float-left input-line-height"><?php _se('Phablet'); ?></label>
									<input type="number" name="listing_columns_phablet" id="listing_columns_phablet" class="text-input c2" value="<?php echo CHV\Settings::get('listing_columns_phablet', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('listing_columns_phablet', true); ?>" pattern="\d*" min="1" max="8" required>
								</div>
								<div class="overflow-auto margin-bottom-10">
									<label for="listing_columns_tablet" class="c2 float-left input-line-height"><?php _se('Tablet'); ?></label>
									<input type="number" name="listing_columns_tablet" id="listing_columns_tablet" class="text-input c2" value="<?php echo CHV\Settings::get('listing_columns_tablet', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('listing_columns_tablet', true); ?>" pattern="\d*" min="1" max="8" required>
								</div>
								<div class="overflow-auto margin-bottom-10">
									<label for="listing_columns_laptop" class="c2 float-left input-line-height"><?php _se('Laptop'); ?></label>
									<input type="number" name="listing_columns_laptop" id="listing_columns_laptop" class="text-input c2" value="<?php echo CHV\Settings::get('listing_columns_laptop', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('listing_columns_laptop', true); ?>" pattern="\d*" min="1" max="8" required>
								</div>
								<div class="overflow-auto margin-bottom-10">
									<label for="listing_columns_desktop" class="c2 float-left input-line-height"><?php _se('Desktop'); ?></label>
									<input type="number" name="listing_columns_desktop" id="listing_columns_desktop" class="text-input c2" value="<?php echo CHV\Settings::get('listing_columns_desktop', true); ?>" placeholder="<?php echo CHV\Settings::getDefault('listing_columns_desktop', true); ?>" pattern="\d*" min="1" max="8" required>
								</div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['listing_columns']; ?></div>
							</div>
						<?php
                        } ?>

						<?php if (get_settings()['key'] == 'theme') { ?>
							<p><?php echo read_the_docs_settings('theme', _s('theme')); ?></p>
							<hr class="line-separator">
							<div class="input-label">
								<label for="theme"><?php _se('Theme'); ?></label>
								<?php
                                $themes = [];
                            foreach (scandir(G_APP_PATH_THEMES) as $v) {
                                if (is_dir(G_APP_PATH_THEMES . DIRECTORY_SEPARATOR . $v) and !in_array($v, ['.', '..'])) {
                                    $themes[$v] = $v;
                                }
                            } ?>
								<div class="c5 phablet-c1">
									<select type="text" name="theme" id="theme" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html($themes, CHV\Settings::get('theme')); ?>
									</select>
								</div>
								<div class="input-below"><?php echo _se('Put your themes in the %s folder', G_APP_PATH_THEMES); ?></div>
							</div>
							<hr class="line-separator">
							<div class="input-label">
								<label for="theme_tone"><?php _se('Tone'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_tone" id="theme_tone" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html(['light' => _s('Light'), 'dark' => _s('Dark')], get_safe_post() ? get_safe_post()['theme_tone'] : CHV\Settings::get('theme_tone'), CHV\Settings::get('theme_tone')); ?>
									</select></div>
								<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['theme_tone']; ?></div>
							</div>

							<div class="input-label">
								<label for="theme_main_color"><?php _se('Main color'); ?></label>
								<div class="c4"><input type="text" name="theme_main_color" id="theme_main_color" class="text-input" value="<?php echo CHV\Settings::get('theme_main_color', true); ?>" placeholder="#3498db" pattern="#?([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})" title="<?php _se('Hexadecimal color value'); ?>" rel="toolTip" data-tipTip="right"></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['theme_main_color']; ?></div>
								<div class="input-below"><?php _se('Use this to set the main theme color. Value must be in <a href="%s" target="_blank">hex format</a>.', 'http://www.color-hex.com/'); ?></div>
							</div>

							<div class="input-label">
								<label for="theme_top_bar_button_color"><?php _se('Top bar button color'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_top_bar_button_color" id="theme_top_bar_button_color" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([
                                            'blue' => _s('Blue'),
                                            'green' => _s('Green'),
                                            'orange' => _s('Orange'),
                                            'red' => _s('Red'),
                                            'grey' => _s('Grey'),
                                            'black' => _s('Black'),
                                            'white' => _s('White'),
                                            'default' => _s('Default'),
                                        ], get_safe_post() ? get_safe_post()['theme_top_bar_button_color'] : CHV\Settings::get('theme_top_bar_button_color'), CHV\Settings::get('theme_top_bar_button_color')); ?>
									</select></div>
								<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['theme_top_bar_button_color']; ?></div>
								<div class="input-below"><?php _se('Color for the top bar buttons like the "Create account" button.'); ?></div>
							</div>

							<hr class="line-separator">

							<?php
                            if (!is_writable(CHV_PATH_CONTENT_IMAGES_SYSTEM)) {
                                ?>
								<p class="highlight"><?php _se("Warning: Can't write in %s", CHV_PATH_CONTENT_IMAGES_SYSTEM); ?></p>
							<?php
                            } ?>

							<div class="input-label">
								<label for="logo_vector_enable"><?php _se('Enable vector logo'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="logo_vector_enable" id="logo_vector_enable" class="text-input" data-combo="logo-vector-combo">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['logo_vector_enable'] : CHV\Settings::get('logo_vector_enable')); ?>
									</select></div>
								<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['logo_vector_enable']; ?></div>
								<div class="input-below"><?php _se('Enable vector logo for high quality logo in devices with high pixel density.'); ?></div>
							</div>
							<div id="logo-vector-combo">
								<div data-combo-value="1" class="switch-combo c9 phablet-c1<?php if ((get_safe_post() ? get_safe_post()['logo_vector_enable'] : CHV\Settings::get('logo_vector_enable')) != 1) {
                                            echo ' soft-hidden';
                                        } ?>">
									<div class="input-label">
										<label for="logo_vector"><?php _se('Vector logo image'); ?></label>
										<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('logo_vector')) . '?' . G\random_string(8); ?>"></div>
										<div class="c5 phablet-c1">
											<input id="logo_vector" name="logo_vector" type="file" accept="image/svg">
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['logo_vector']; ?></div>
										<div class="input-below"><?php _se('Vector version or your website logo in SVG format.'); ?></div>
									</div>
								</div>
							</div>

							<div class="input-label">
								<label for="logo_image"><?php _se('Raster logo image'); ?></label>
								<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('logo_image')) . '?' . G\random_string(8); ?>"></div>
								<div class="c5 phablet-c1">
									<input id="logo_image" name="logo_image" type="file" accept="image/*">
								</div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['logo_image']; ?></div>
								<div class="input-below"><?php _se('Bitmap version or your website logo. PNG format is recommended.'); ?></div>
							</div>

							<div class="input-label">
								<label for="theme_logo_height"><?php _se('Logo height'); ?></label>
								<div class="c4"><input type="number" min="0" pattern="\d+" name="theme_logo_height" id="theme_logo_height" class="text-input" value="<?php echo CHV\Settings::get('theme_logo_height'); ?>" placeholder="<?php _se('No value'); ?>"></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['theme_logo_height']; ?></div>
								<div class="input-below"><?php _se('Use this to set the logo height if needed.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="favicon_image"><?php _se('Favicon image'); ?></label>
								<div class="transparent-canvas dark margin-bottom-10" style="max-width: 100px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('favicon_image')) . '?' . G\random_string(8); ?>"></div>
								<div class="c5 phablet-c1">
									<input id="favicon_image" name="favicon_image" type="file" accept="image/*">
								</div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['favicon_image']; ?></div>
								<div class="input-below"><?php _se('Favicon image. Image must have same width and height.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="image_load_max_filesize_mb"><?php _se('Image load max. filesize'); ?> (MB)</label>
								<div class="c2"><input type="number" min="0" pattern="\d+" name="image_load_max_filesize_mb" id="image_load_max_filesize_mb" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['image_load_max_filesize_mb'] : CHV\Settings::get('image_load_max_filesize_mb'); ?>" placeholder="MB"></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['image_load_max_filesize_mb']; ?></div>
								<div class="input-below"><?php _se('Images greater than this size will show a button to load full resolution image.'); ?></div>
							</div>

							<div class="input-label">
								<label for="theme_download_button"><?php _se('Enable download button'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_download_button" id="theme_download_button" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_download_button')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to show the image download button.'); ?></div>
							</div>

							<div class="input-label">
								<label for="theme_image_right_click"><?php _se('Enable right click on image'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_image_right_click" id="theme_image_right_click" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_image_right_click')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to allow right click on image viewer page.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="theme_show_exif_data"><?php _se('Enable show Exif data'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_show_exif_data" id="theme_show_exif_data" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_show_exif_data')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to show image Exif data.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="theme_show_social_share"><?php _se('Enable social share'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_show_social_share" id="theme_show_social_share" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_show_social_share')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to show social network buttons to share content.'); ?></div>
							</div>

							<div class="input-label">
								<label for="theme_show_embed_content_for"><?php _se('Enable embed codes (content)'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_show_embed_content_for" id="theme_show_embed_content_for" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([
                                            'all' => _s('Everybody'),
                                            'users' => _s('Users only'),
                                            'none' => _s('Disabled')
                                            ], CHV\Settings::get('theme_show_embed_content_for')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to show embed codes for the content.'); ?></div>
                            </div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="theme_nsfw_upload_checkbox"><?php _se('Not safe content checkbox in uploader'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="theme_nsfw_upload_checkbox" id="theme_nsfw_upload_checkbox" class="text-input">
										<?php
                                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('theme_nsfw_upload_checkbox')); ?>
									</select></div>
								<div class="input-below"><?php _se('Enable this if you want to show a checkbox to indicate not safe content upload.'); ?></div>
							</div>

							<hr class="line-separator">

							<div class="input-label">
								<label for="theme_custom_css_code"><?php _se('Custom CSS code'); ?></label>
								<div class="c12 phablet-c1"><textarea type="text" name="theme_custom_css_code" id="theme_custom_css_code" class="text-input r4" placeholder="<?php _se('Put your custom CSS code here. It will be placed as <style> just before the closing </head> tag.'); ?>"><?php echo CHV\Settings::get('theme_custom_css_code', true); ?></textarea></div>
							</div>

							<div class="input-label">
								<label for="theme_custom_js_code"><?php _se('Custom JS code'); ?></label>
								<div class="c12 phablet-c1"><textarea type="text" name="theme_custom_js_code" id="theme_custom_js_code" class="text-input r4" placeholder="<?php _se('Put your custom JS code here. It will be placed as <script> just before the closing </head> tag.'); ?>"><?php echo CHV\Settings::get('theme_custom_js_code', true); ?></textarea></div>
								<div class="input-below"><?php _se('Do not use %s markup here. This is for plain JS code, not for HTML script tags. If you use script tags here you will break your website.', '&lt;script&gt;'); ?></div>
							</div>

						<?php
                        } ?>

						<?php if (get_settings()['key'] == 'homepage') {
                            ?>
                            <p><?php echo read_the_docs_settings('homepage', _s('homepage')); ?></p>
							<div class="input-label">
								<label for="homepage_style"><?php _se('Style'); ?></label>
								<div class="c5 phablet-c1"><select type="text" name="homepage_style" id="homepage_style" class="text-input" data-combo="home-style-combo">
										<?php
                                        echo CHV\Render\get_select_options_html([
                                            'landing' => _s('Landing page'),
                                            'split' => _s('Split landing + images'),
                                            'route_explore' => _s('Route %s', _s('explore')),
                                            'route_upload' => _s('Route %s', _s('upload')),
                                        ], CHV\Settings::get('homepage_style')); ?>
									</select></div>
								<div class="input-below input-warning red-warning"><?php echo get_input_errors()['homepage_style']; ?></div>
								<div class="input-below"><?php _se('Select the homepage style. To customize it further edit app/themes/%s/views/index.php', CHV\Settings::get('theme')); ?></div>
							</div>
							<div id="home-style-combo">
								<div data-combo-value="landing split" class="switch-combo<?php if (!in_array((get_safe_post() ? get_safe_post()['homepage_style'] : CHV\Settings::get('homepage_style')), ['split', 'landing'])) {
                                            echo ' soft-hidden';
                                        } ?>">
									<?php
                                    foreach (CHV\Settings::get('homepage_cover_images') as $k => $v) {
                                        $cover_index = $k + 1;
                                        $cover_label = 'homepage_cover_image_' . $k; ?>
										<div class="input-label">
											<label for="<?php echo $cover_label; ?>"><?php _se('Cover image');
                                        echo ' (' . $cover_index . ')'; ?></label>
											<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo $v['url']; ?>"></div>
											<?php if (count(CHV\Settings::get('homepage_cover_images')) > 1) {
                                            ?>
												<div class="margin-top-10 margin-bottom-10">
													<a class="delete-link" data-confirm="<?php _se("Do you really want to delete this image? This can't be undone."); ?>" href="<?php echo G\get_base_url('dashboard/settings/homepage?action=delete-cover&cover=' . $cover_index); ?>"><?php _se('Delete image'); ?></a>
												</div>
											<?php
                                        } ?>
											<div class="c5 phablet-c1">
												<input id="<?php echo $cover_label; ?>" name="<?php echo $cover_label; ?>" type="file" accept="image/*">
											</div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['homepage_cover_image_' . $k]; ?></div>
										</div>
									<?php
                                    } ?>
									<div class="input-label">
										<label for="homepage_cover_image_add"><?php _se('Add new cover image'); ?></label>
										<div class="c5 phablet-c1">
											<input id="homepage_cover_image_add" name="homepage_cover_image_add" type="file" accept="image/*">
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['homepage_cover_image_add']; ?></div>
									</div>

									<?php if (CHV\Settings::get('logo_vector_enable')) {
                                        ?>

										<hr class="line-separator">

										<div class="input-label">
											<label for="logo_vector_homepage"><?php _se('Vector logo image'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
											<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('logo_vector_homepage')) . '?' . G\random_string(8); ?>"></div>
											<div class="c5 phablet-c1">
												<input id="logo_vector_homepage" name="logo_vector_homepage" type="file" accept="image/svg">
											</div>
											<div class="input-below input-warning red-warning"><?php echo get_input_errors()['logo_vector_homepage']; ?></div>
											<div class="input-below"><?php _se('Vector version or your website logo in SVG format (only for homepage).'); ?></div>
										</div>
									<?php
                                    } // landing logo vector?>
									<div class="input-label">
										<label for="logo_image_homepage"><?php _se('Raster logo image'); ?> <span class="optional"><?php _se('optional'); ?></span></label>
										<div class="transparent-canvas dark margin-bottom-10" style="max-width: 200px;"><img class="display-block" width="100%" src="<?php echo CHV\get_system_image_url(CHV\Settings::get('logo_image_homepage')) . '?' . G\random_string(8); ?>"></div>
										<div class="c5 phablet-c1">
											<input id="logo_image_homepage" name="logo_image_homepage" type="file" accept="image/*">
										</div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['logo_image_homepage']; ?></div>
										<div class="input-below"><?php _se('Bitmap version or your website logo (only for homepage). PNG format is recommended.'); ?></div>
									</div>

									<hr class="line-separator">

									<div class="input-label">
										<label for="homepage_title_html"><?php _se('Title'); ?></label>
										<div class="c12 phablet-c1"><textarea type="text" name="homepage_title_html" id="homepage_title_html" class="text-input r2 resize-vertical" placeholder="<?php echo G\safe_html(_s('This will be added inside the homepage %s tag. Leave it blank to use the default contents.', '<h1>')); ?>"><?php echo CHV\Settings::get('homepage_title_html'); ?></textarea></div>
									</div>

									<div class="input-label">
										<label for="homepage_paragraph_html"><?php _se('Paragraph'); ?></label>
										<div class="c12 phablet-c1"><textarea type="text" name="homepage_paragraph_html" id="homepage_paragraph_html" class="text-input r2 resize-vertical" placeholder="<?php echo G\safe_html(_s('This will be added inside the homepage %s tag. Leave it blank to use the default contents.', '<p>')); ?>"><?php echo CHV\Settings::get('homepage_paragraph_html'); ?></textarea></div>
									</div>

									<hr class="line-separator">

									<div class="input-label">
										<label for="homepage_cta_color"><?php _se('Call to action button color'); ?></label>
										<div class="c5 phablet-c1"><select type="text" name="homepage_cta_color" id="homepage_cta_color" class="text-input">
												<?php
                                                echo CHV\Render\get_select_options_html([
                                                    'blue' => _s('Blue'),
                                                    'green' => _s('Green'),
                                                    'orange' => _s('Orange'),
                                                    'red' => _s('Red'),
                                                    'grey' => _s('Grey'),
                                                    'black' => _s('Black'),
                                                    'white' => _s('White'),
                                                    'default' => _s('Default'),
                                                ], get_safe_post() ? get_safe_post()['homepage_cta_color'] : CHV\Settings::get('homepage_cta_color'), CHV\Settings::get('homepage_cta_color')); ?>
											</select></div>
										<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['homepage_cta_color']; ?></div>
										<div class="input-below"><?php _se('Color of the homepage call to action button.'); ?></div>
									</div>

									<div class="input-label">
										<label for="homepage_cta_outline"><?php _se('Call to action outline style button'); ?></label>
										<div class="c5 phablet-c1"><select type="text" name="homepage_cta_outline" id="homepage_cta_outline" class="text-input">
												<?php
                                                echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('homepage_cta_outline')); ?>
											</select></div>
										<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['homepage_cta_outline']; ?></div>
										<div class="input-below"><?php _se('Enable this to use outline style for the homepage call to action button.'); ?></div>
									</div>

									<div class="input-label">
										<label for="homepage_cta_fn"><?php _se('Call to action functionality'); ?></label>
										<div class="c5 phablet-c1"><select type="text" name="homepage_cta_fn" id="homepage_cta_fn" class="text-input" data-combo="cta-fn-combo">
												<?php
                                                echo CHV\Render\get_select_options_html([
                                                    'cta-upload' => _s('Trigger uploader'),
                                                    'cta-link' => _s('Open URL'),
                                                ], CHV\Settings::get('homepage_cta_fn')); ?>
											</select></div>
										<div class="input-warning red-warning"><?php echo get_input_errors()['homepage_cta_fn']; ?></div>
									</div>
									<div id="cta-fn-combo">
										<div data-combo-value="cta-link" class="switch-combo<?php if ((get_safe_post() ? get_safe_post()['homepage_cta_fn'] : CHV\Settings::get('homepage_cta_fn')) !== 'cta-link') {
                                                    echo ' soft-hidden';
                                                } ?>">
											<div class="input-label">
												<label for="homepage_cta_fn_extra"><?php _se('Call to action URL'); ?></label>
												<div class="c9 phablet-c1"><input type="text" name="homepage_cta_fn_extra" id="homepage_cta_fn_extra" class="text-input" value="<?php echo CHV\Settings::get('homepage_cta_fn_extra', true); ?>" placeholder="<?php _se('Enter an absolute or relative URL'); ?>" <?php echo ((get_safe_post() ? get_safe_post()['homepage_cta_fn'] : CHV\Settings::get('homepage_cta_fn')) !== 'cta-link') ? 'data-required' : 'required'; ?>></div>
												<div class="input-below input-warning red-warning"><?php echo get_input_errors()['homepage_cta_fn_extra']; ?></div>
												<div class="input-below"><?php _se('A relative URL like %r will be mapped to %l', ['%r' => 'page/welcome', '%l' => G\get_base_url('page/welcome')]); ?></div>
											</div>
										</div>
									</div>

									<div class="input-label">
										<label for="homepage_cta_html"><?php _se('Call to action HTML'); ?></label>
										<div class="c12 phablet-c1"><textarea type="text" name="homepage_cta_html" id="homepage_cta_html" class="text-input r2 resize-vertical" placeholder="<?php echo G\safe_html(_s('This will be added inside the call to action <a> tag. Leave it blank to use the default contents.')); ?>"><?php echo CHV\Settings::get('homepage_cta_html'); ?></textarea></div>
									</div>

								</div>
								<div data-combo-value="split" class="switch-combo<?php if ((get_safe_post() ? get_safe_post()['homepage_style'] : CHV\Settings::get('homepage_style')) !== 'split') {
                                                    echo ' soft-hidden';
                                                } ?>">
									<div class="input-label">
										<label for="homepage_uids"><?php _se('User IDs'); ?></label>
										<div class="c4"><input type="text" name="homepage_uids" id="homepage_uids" class="text-input" value="<?php echo CHV\Settings::get('homepage_uids', true); ?>" placeholder="<?php _se('Empty'); ?>" rel="tooltip" title="<?php _se('Your user id is: %s', CHV\Login::getUser()['id']); ?>" data-tipTip="right"></div>
										<div class="input-below input-warning red-warning"><?php echo get_input_errors()['homepage_uids']; ?></div>
										<div class="input-below"><?php _se('Comma-separated list of target user IDs (integers) to show most recent images on homepage. Leave it empty to display trending images.'); ?></div>
									</div>
								</div>
							</div>

						<?php
                        } ?>
			<?php if (get_settings()['key'] == 'system') {
                            ?>
            <p><?php echo read_the_docs_settings('system', _s('system')); ?></p>
            <div class="input-label">
				<label for="enable_automatic_updates_check"><?php _se('Automatic updates check'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="enable_automatic_updates_check" id="enable_automatic_updates_check" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_automatic_updates_check')); ?>
				</select></div>
				<div class="input-below input-warning red-warning"><?php echo get_input_errors()['enable_automatic_updates_check']; ?></div>
				<div class="input-below"><?php _se('When enabled the system will automatically check for new updates.'); ?></div>
			</div>
			<div class="input-label">
				<label for="update_check_display_notification"><?php _se('Display available updates notification'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="update_check_display_notification" id="update_check_display_notification" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([0 => _s('Disabled'), 1 => _s('Enabled')], CHV\Settings::get('update_check_display_notification')); ?>
				</select></div>
				<div class="input-below input-warning red-warning"><?php echo get_input_errors()['update_check_display_notification']; ?></div>
				<div class="input-below"><?php _se('Enable this to show a notice on top warning you about new available system updates.'); ?></div>
			</div>

			<div class="input-label">
				<label for="dump_update_query"><?php _se('Dump update query'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="dump_update_query" id="dump_update_query" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([0 => _s('Disabled'), 1 => _s('Enabled')], CHV\Settings::get('dump_update_query')); ?>
				</select></div>
				<div class="input-below input-warning red-warning"><?php echo get_input_errors()['dump_update_query']; ?></div>
				<div class="input-below"><?php _se('Enable this if you want to dump the update query to run it manually.'); ?></div>
			</div>

			<hr class="line-separator">
			<?php foreach (['image', 'album'] as $v) {
                                ?> 
			<div class="input-label">
				<label for="seo_<?php echo $v; ?>_urls"><?php _se('SEO %s URLs', _s($v)); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="seo_<?php echo $v; ?>_urls" id="seo_<?php echo $v; ?>_urls" class="text-input">
					<?php
                                echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('seo_' . $v . '_urls')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this if you want to use SEO %s URLs.', _s($v)); ?></div>
			</div>
			<?php
                            } ?>
			<hr class="line-separator">
			<div class="input-label">
				<label for="minify_enable"><?php _se('Minify code'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="minify_enable" id="minify_enable" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('minify_enable')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this if you want to auto minify CSS and JS code.'); ?></div>
			</div>
			<div class="input-label">
				<label for="website_search"><?php _se('Maintenance'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="maintenance" id="maintenance" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([0 => _s('Disabled'), 1 => _s('Enabled')], CHV\Settings::get('maintenance')); ?>
				</select></div>
				<div class="input-below"><?php _se("When enabled the website will show a maintenance message. This setting doesn't affect administrators."); ?></div>
			</div>
			<hr class="line-separator">
			<div class="input-label">
				<label for="crypt_salt"><?php _se('Crypt salt'); ?></label>
				<div class="c5 phablet-c1"><input type="text" name="crypt_salt" id="crypt_salt" class="text-input" value="<?php echo CHV\Settings::get('crypt_salt'); ?>" disabled></div>
				<div class="input-below"><?php _se('This is the salt used to convert numeric ID to alphanumeric. It was generated on install.'); ?></div>
			</div>
			<hr class="line-separator">
			<div class="input-label">
				<label for="error_reporting"><?php _se('PHP error reporting'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="error_reporting" id="error_reporting" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('error_reporting')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this if you want to print errors generated by PHP <a %s>error_reporting()</a>. This should be disabled in production.', 'href="http://php.net/manual/en/function.error-reporting.php" target="_blank"'); ?></div>
			</div>
			<div class="input-label">
				<label for="debug_level"><?php _se('Debug level'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="debug_level" id="debug_level" class="text-input" disabled>
					<?php
                            echo CHV\Render\get_select_options_html([0 => _s('None'), 1 => _s('Error log'), 2 => _s('Print errors without error log'), 3 => _s('Print and log errors')], G\get_app_setting('debug_level')); ?>
				</select></div>
				<div class="input-below"><?php _se('To configure the debug level check the <a %s>debug documentation</a>. Default level is "Error log" (1).', 'href="https://goo.gl/UQtZEf" target="_blank"'); ?></div>
			</div>

			<?php
                        } ?>

			<?php if (get_settings()['key'] == 'routing') {
                            ?>
			<p><?php _se('Routing allows you to customize default route binds on the fly. Only alphanumeric, hyphen and underscore characters are allowed.'); ?> <?php echo read_the_docs_settings('routing', _s('routing')); ?></p>
			<div class="input-label">
				<label for="route_image"><?php _se('Image routing'); ?></label>
				<div class="c9 phablet-c1">
					<input type="text" name="route_image" id="route_image" class="text-input" value="<?php echo CHV\Settings::get('route_image', true); ?>" required pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$" placeholder="image">
				</div>
				<div class="input-below input-warning red-warning"><?php echo get_input_errors()['route_image']; ?></div>
				<div class="input-below"><?php _se('Routing for %s', G\get_base_url('image/&lt;id&gt;')); ?></div>
			</div>
			<div class="input-label">
				<label for="route_album"><?php _se('Album routing'); ?></label>
				<div class="c9 phablet-c1">
					<input type="text" name="route_album" id="route_album" class="text-input" value="<?php echo CHV\Settings::get('route_album', true); ?>" required pattern="^[a-z0-9]+(?:-[a-z0-9]+)*$" placeholder="album">
				</div>
				<div class="input-below input-warning red-warning"><?php echo get_input_errors()['route_album']; ?></div>
				<div class="input-below"><?php _se('Routing for %s', G\get_base_url('album/&lt;id&gt;')); ?></div>
			</div>
			<hr class="line-separator">
			<div class="c24 phablet-c1 highlight text-content padding-10 margin-bottom-0">
				<h3 class="margin-top-10 margin-bottom-10 font-weight-bold">Subdomain wildcards</h3>
				<p>Both language and username subdomains are highly experimental features that require advanced server configurations. The alleged functionalities should be enabled only after setting up a subdomain wildcard pointing to your Chevereto installation. You also need to enable CORS for these subdomains. If you want to use HTTPS, you also need to bind the SSL certificate(s) for your subdomains.</p>
				<p><b>Don't ask us how to make this work for your installation.</b> These are experimental features, and we don't have any guidance on how to fulfill the server requirements listed above as we are still collecting feedback from pro users. We will publish instructions (if any) in the future.</p>
			</div>
			<div class="input-label">
				<label for="hostname"><?php _se('Hostname'); ?></label>
				<div class="c9 phablet-c1">
					<input type="text" name="hostname" id="hostname" class="text-input" value="<?php echo CHV\Settings::get('hostname', true); ?>" pattern="^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$" placeholder="<?php echo G\get_domain(G_HTTP_HOST); ?>">
				</div>
				<div class="input-below input-warning red-warning"><?php echo get_input_errors()['hostname']; ?></div>
				<div class="input-below"><?php _se('Hostname on which sub-domain wildcards will be added.'); ?> <?php _se('This setting may be overridden by %s.', '<code>app/settings.php</code>'); ?></div>
			</div>
			<div class="input-label">
				<label for="lang_subdomain_wildcard"><?php _se('Language subdomains'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="lang_subdomain_wildcard" id="lang_subdomain_wildcard" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('lang_subdomain_wildcard')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable to use %s for %t.', ['%t' => _s('languages'), '%s' => G\str_replace_first(CHV_HTTP_HOST, 'es' . '.' . CHV_HTTP_HOST, CHV_ROOT_URL)]); ?></div>
			</div>
			<div class="input-label">
				<label for="user_subdomain_wildcard"><?php _se('Username subdomains'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="user_subdomain_wildcard" id="user_subdomain_wildcard" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('user_subdomain_wildcard')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable to use %s for %t.', ['%t' => _s('user profiles'), '%s' => G\str_replace_first(CHV_HTTP_HOST, 'username' . '.' . CHV_HTTP_HOST, CHV_ROOT_URL)]); ?></div>
			</div>
			<?php
                        } ?>

			<?php if (get_settings()['key'] == 'languages') {
                            ?>
            <p><?php echo read_the_docs_settings('languages', _s('languages')); ?></p>
            <div class="input-label">
				<label><?php _se('Custom language strings'); ?></label>
			</div>
			<div class="input-label">
				<label for="default_language"><?php _se('Default language'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="default_language" id="default_language" class="text-input">
					<?php
                            foreach (CHV\get_available_languages() as $k => $v) {
                                $selected_lang = $k == CHV\Settings::get('default_language') ? ' selected' : '';
                                echo '<option value="' . $k . '"' . $selected_lang . '>' . $v['name'] . '</option>' . "\n";
                            } ?>
				</select></div>
				<div class="input-below"><?php _se('Default base language to use.'); ?></div>
			</div>

			<div class="input-label">
				<label for="auto_language"><?php _se('Auto language'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="auto_language" id="auto_language" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('auto_language')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this if you want to automatically detect and set the right language for each user.'); ?></div>
			</div>

			<div class="input-label">
				<label for="language_chooser_enable"><?php _se('Language chooser'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="language_chooser_enable" id="language_chooser_enable" class="text-input" data-combo="language-enable-combo">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('language_chooser_enable')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this if you want to allow language selection.'); ?></div>
			</div>

			<?php if (count(CHV\get_available_languages()) > 0) {
                                ?>
			<div id="language-enable-combo">
				<div data-combo-value="1" class="switch-combo<?php if ((get_safe_post() ? get_safe_post()['language_chooser_enable'] == 0 : !CHV\Settings::get('language_chooser_enable'))) {
                                    echo ' soft-hidden';
                                } ?>">
					<div class="checkbox-label">
						<h4 class="input-label-label"><?php _se('Enabled languages'); ?></h4>
						<ul class="c20 phablet-c1">
							<?php
                                foreach (CHV\get_available_languages() as $k => $v) {
                                    $lang_flag = array_key_exists($k, CHV\get_enabled_languages()) ? ' checked' : null;
                                    echo '<li class="c5 phone-c1 display-inline-block"><label class="display-block" for="languages_enable[' . $k . ']"> <input type="checkbox" name="languages_enable[]" id="languages_enable[' . $k . ']" value="' . $k . '"' . $lang_flag . '>' . $v['name'] . '</label></li>';
                                } ?>
						</ul>
						<p class="margin-top-20"><?php _se("Unchecked languages won't be used in your website."); ?></p>
					</div>
				</div>
			</div>
			<?php
                            } ?>

			<?php
                        } ?>
			<?php if (get_settings()['key'] == 'email') {
                            ?>
            <p><?php echo read_the_docs_settings('email', _s('email')); ?></p>
            <div class="input-label">
				<label for="email_from_name"><?php _se('From name'); ?></label>
				<div class="c9 phablet-c1"><input type="text" name="email_from_name" id="email_from_name" class="text-input" value="<?php echo CHV\Settings::get('email_from_name', true); ?>" required></div>
				<div class="input-warning red-warning"><?php echo get_input_errors()['email_from_name']; ?></div>
				<div class="input-below"><?php _se('Sender name for emails sent to users.'); ?></div>
			</div>
			<div class="input-label">
				<label for="email_from_email"><?php _se('From email address'); ?></label>
				<div class="c9 phablet-c1"><input type="email" name="email_from_email" id="email_from_email" class="text-input" value="<?php echo CHV\Settings::get('email_from_email', true); ?>" required></div>
				<div class="input-warning red-warning"><?php echo get_input_errors()['email_from_email']; ?></div>
				<div class="input-below"><?php _se('Sender email for emails sent to users.'); ?></div>
			</div>
			<div class="input-label">
				<label for="email_incoming_email"><?php _se('Incoming email address'); ?></label>
				<div class="c9 phablet-c1"><input type="email" name="email_incoming_email" id="email_incoming_email" class="text-input" value="<?php echo CHV\Settings::get('email_incoming_email', true); ?>" required></div>
				<div class="input-warning red-warning"><?php echo get_input_errors()['email_incoming_email']; ?></div>
				<div class="input-below"><?php _se('Recipient for contact form and system alerts.'); ?></div>
			</div>
			<div class="input-label">
				<label for="email_mode"><?php _se('Email mode'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="email_mode" id="email_mode" class="text-input" data-combo="mail-combo">
					<?php
                            echo CHV\Render\get_select_options_html(['smtp' => 'SMTP', 'mail' => 'PHP mail() func.'], get_safe_post() ? get_safe_post()['email_mode'] : CHV\Settings::get('email_mode')); ?>
				</select></div>
				<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['email_mode']; ?></div>
				<div class="input-below"><?php _se('How to send emails? SMTP recommended.'); ?></div>
			</div>
			<div id="mail-combo">
				<?php
                            if ($GLOBALS['SMTPDebug']) {
                                echo '<p class="highlight">' . nl2br($GLOBALS['SMTPDebug']) . '</p>';
                            } ?>
				<div data-combo-value="smtp" class="switch-combo c9 phablet-c1<?php if ((get_safe_post() ? get_safe_post()['email_mode'] : CHV\Settings::get('email_mode')) !== 'smtp') {
                                echo ' soft-hidden';
                            } ?>">
					<div class="input-label">
						<label for="email_smtp_server"><?php _se('SMTP server and port'); ?></label>
						<div class="overflow-auto">
							<div class="c7 float-left">
								<input type="text" name="email_smtp_server" id="email_smtp_server" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['email_smtp_server'] : CHV\Settings::get('email_smtp_server'); ?>" placeholder="<?php _se('SMTP server'); ?>">
							</div>
							<div class="c2 float-left margin-left-10">
								<select type="text" name="email_smtp_server_port" id="email_smtp_server_port" class="text-input">
									<?php
                                    echo CHV\Render\get_select_options_html([25 => 25, 80 => 80, 465 => 465, 587 => 587], get_safe_post() ? get_safe_post()['email_smtp_server_port'] : CHV\Settings::get('email_smtp_server_port')); ?>
								</select>
							</div>
						</div>
						<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['email_smtp_server']; ?></div>
					</div>
					<div class="input-label">
						<label for="email_smtp_server_username"><?php _se('SMTP username'); ?></label>
						<input type="text" name="email_smtp_server_username" id="email_smtp_server_username" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['email_smtp_server_username'] : CHV\Settings::get('email_smtp_server_username'); ?>">
						<div class="input-below input-warning red-warning"><?php echo get_input_errors()['email_smtp_server_username']; ?></div>
					</div>
					<div class="input-label">
						<label for="email_smtp_server_password"><?php _se('SMTP password'); ?></label>
						<input type="password" name="email_smtp_server_password" id="email_smtp_server_password" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['email_smtp_server_password'] : CHV\Settings::get('email_smtp_server_password'); ?>">
						<div class="input-below input-warning red-warning"><?php echo get_input_errors()['email_smtp_server_password']; ?></div>
					</div>
					<div class="input-label c5">
						<label for="email_smtp_server_security"><?php _se('SMTP security'); ?></label>
						<select type="text" name="email_smtp_server_security" id="email_smtp_server_security" class="text-input">
							<?php
                            echo CHV\Render\get_select_options_html(['tls' => 'TLS', 'ssl' => 'SSL', 'unsecured' => _s('Unsecured')], get_safe_post() ? get_safe_post()['email_smtp_server_security'] : CHV\Settings::get('email_smtp_server_security')); ?>
						</select>
						<div class="input-below input-warning red-warning clear-both"><?php echo get_input_errors()['email_smtp_server_security']; ?></div>
					</div>
				</div>
			</div>
			<?php
                        } ?>

      <?php if (get_settings()['key'] == 'tools') {
                            ?>
        <p><?php echo read_the_docs_settings('tools', _s('tools')); ?></p>
        <div class="input-label">
			<label for="decode-id"><?php _se('Decode ID'); ?></label>
			<div class="phablet-c1">
				<input type="text" data-dashboard-tool="decodeId" name="decode-id" id="decode-id" class="c4 text-input" placeholder="<?php echo CHV\encodeID(1337); ?>"> <a class="btn btn-input default" data-action="dashboardTool" data-tool="decodeId" data-data='{"id":"#decode-id"}'><span class="loading display-inline-block"></span><span class="text"><?php _se('Decode ID'); ?></span></a>
			</div>
		</div>
		<div class="input-label">
        	<label for="encode-id"><?php _se('Encode ID'); ?></label>
			<div class="phablet-c1">
				<input type="number" data-dashboard-tool="encodeId" min="0" name="encode-id" id="encode-id" class="c4 text-input" placeholder="1234"> <a class="btn btn-input default" data-action="dashboardTool" data-tool="encodeId" data-data='{"id":"#encode-id"}'><span class="loading display-inline-block"></span><span class="text"><?php _se('Encode ID'); ?></span></a>
			</div>
		</div>
		<hr class="line-separator">
		<div class="input-label">
        	<label for="test-email"><?php _se('Send test email'); ?></label>
			<div class="phablet-c1">
				<input type="email" data-dashboard-tool="testEmail" name="test-email" id="test-email" class="c4 text-input" placeholder="test@mail.com"> <a class="btn btn-input default" data-action="dashboardTool" data-tool="testEmail" data-data='{"email":"#test-email"}'><span class="loading display-inline-block"></span><span class="text"><?php _se('Send test email'); ?></span></a>
			</div>
        	<div class="input-below"><?php _se('Use this to test how your emails are being delivered. We recommend you to use %s.', '<a href="https://www.mail-tester.com/" target="_blank">mail-tester</a>'); ?></div>
		</div>
		<hr class="line-separator">
		<div class="input-label">
			<label for="export-user"><?php _se('Export a user'); ?></label>
			<div class="phablet-c1">
				<input type="text" data-dashboard-tool="exportUser" name="export-user" min="1" id="export-user" class="c4 text-input" placeholder="<?php _se('Username'); ?>"> <a class="btn btn-input default" data-action="dashboardTool" data-tool="exportUser" data-data='{"username":"#export-user"}'><span class="loading display-inline-block"></span><span class="text"><?php _se('Export user'); ?></span></a>
			</div>
        	<div class="input-below"><?php _se("This will allow you to download a user's standard personal information in JSON format."); ?></div>
		</div>
		<hr class="line-separator">
		<div class="input-label">
			<label for="storageId"><?php _se('Regenerate external storage stats'); ?></label>
			<div class="phablet-c1">
				<input type="number" data-dashboard-tool="regenStorageStats" min="0" step="1" name="storageId" id="storageId" class="c4 text-input" placeholder="<?php _se('Storage id'); ?>"> <a class="btn btn-input default" data-action="dashboardTool" data-tool="regenStorageStats" data-data='{"storageId":"#storageId"}'><span class="loading display-inline-block"></span>
				<span class="text"><?php _se('Regenerate'); ?></span></a>
			</div>
			<div class="input-below"><?php _se('This will re-calculate the sum of all the image records associated to the target external storage.'); ?></div>
		</div>
		<hr class="line-separator">
		<div class="input-label">
			<label for="sourceStorageId"><?php _se('Migrate image records from one external storage to another'); ?></label>
			<div class="phablet-c1">
				<input type="number" data-dashboard-tool="migrateStorage" min="0" step="1" name="sourceStorageId" id="sourceStorageId" class="c5 text-input" placeholder="<?php _se('Source storage id'); ?>">
				<input type="number" data-dashboard-tool="migrateStorage" min="0" step="1" name="targetStorageId" id="targetStorageId" class="c5 text-input" placeholder="<?php _se('Target storage id'); ?>">
				<a class="btn btn-input default" data-action="dashboardTool" data-tool="migrateStorage" data-data='{"sourceStorageId":"#sourceStorageId", "targetStorageId":"#targetStorageId"}'>
					<span class="loading display-inline-block"></span>
					<span class="text"><?php _se('Migrate'); ?></span>
				</a>
			</div>
			<div class="input-below"><?php _se('This only updates the database. You must transfer the actual files to target storage container on your own. URL rewriting is strongly recommended. Use zero (0) for local storage.'); ?></div>
		</div>
      <?php
                        } ?>

			<?php if (get_settings()['key'] == 'external-services') {
                            ?>
			<p><?php echo read_the_docs_settings('external-services', _s('external services')); ?></p>
			<div class="input-label">
				<label for="akismet"><?php _se('%s spam protection', 'Akismet'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="akismet" id="akismet" class="text-input" data-combo="akismet-combo">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['akismet'] : CHV\Settings::get('akismet')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this to use %l to block spam on %c.', [
                                                                        '%l' => '<a href="https://akismet.com/" target="_blank">Akismet</a>',
                                                                        '%c' => _s('user generated content')
                                                                    ]); ?></div>
			</div>
			<div id="akismet-combo" class="c9 phablet-c1">
				<div data-combo-value="1" class="switch-combo<?php if (!(get_safe_post() ? get_safe_post()['akismet'] : CHV\Settings::get('akismet'))) {
                                                                        echo ' soft-hidden';
                                                                    } ?>">
					<div class="input-label">
						<label for="akismet_api_key"><?php _se('%s API key', 'Akismet'); ?></label>
						<input type="text" name="akismet_api_key" id="akismet_api_key" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['akismet_api_key'] : CHV\Settings::get('akismet_api_key', true); ?>" >
						<div class="input-warning red-warning"><?php echo get_input_errors()['akismet_api_key']; ?></div>
					</div>
				</div>
			</div>

			<div class="input-label">
				<label for="stopforumspam"><?php _se('%s spam protection', 'StopForumSpam'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="stopforumspam" id="stopforumspam" class="text-input">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['stopforumspam'] : CHV\Settings::get('stopforumspam')); ?>
				</select></div>
				<div class="input-below"><?php _se('Enable this to use %l to block spam on %c.', [
                                                                        '%l' => '<a href="https://stopforumspam.com/" target="_blank">StopForumSpam</a>',
                                                                        '%c' => _s('user signup')
                                                                    ]); ?></div>
			</div>

			<hr class="line-separator">
			<div class="input-label">
				<label for="cdn">CDN</label>
				<div class="c5 phablet-c1"><select type="text" name="cdn" id="cdn" class="text-input" data-combo="cdn-combo">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['cdn'] : CHV\Settings::get('cdn')); ?>
                </select></div>
			</div>
			<div id="cdn-combo" class="c9 phablet-c1">
				<div data-combo-value="1" class="switch-combo<?php if (!(get_safe_post() ? get_safe_post()['cdn'] : CHV\Settings::get('cdn'))) {
                                echo ' soft-hidden';
                            } ?>">
					<div class="input-label">
						<label for="cdn_url">CDN URL</label>
						<input type="text" name="cdn_url" id="cdn_url" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['cdn_url'] : CHV\Settings::get('cdn_url', true); ?>" placeholder="http://something.netdna-cdn.com/">
						<div class="input-warning red-warning"><?php echo get_input_errors()['cdn_url']; ?></div>
					</div>
				</div>
			</div>
			<hr class="line-separator">
			<div class="input-label">
				<label for="recaptcha">reCAPTCHA</label>
				<div class="c5 phablet-c1"><select type="text" name="recaptcha" id="recaptcha" class="text-input" data-combo="recaptcha-combo">
					<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['recaptcha'] : CHV\Settings::get('recaptcha')); ?>
				</select></div>
				<div class="input-below"><?php _se('You need a <a href="%s" target="_blank">reCAPTCHA key</a> for this.', 'https://www.google.com/recaptcha/intro/index.html'); ?></div>
			</div>
			<div id="recaptcha-combo">
				<div data-combo-value="1" class="switch-combo<?php if (!(get_safe_post() ? get_safe_post()['recaptcha'] : CHV\Settings::get('recaptcha'))) {
                                echo ' soft-hidden';
                            } ?>">
					<div class="input-label">
						<label for="recaptcha_version">reCAPTCHA version</label>
						<div class="c2 phablet-c1"><select type="text" name="recaptcha_version" id="recaptcha_version" class="text-input">
							<?php
                            echo CHV\Render\get_select_options_html([2 => '2', 3 => '3'], get_safe_post() ? get_safe_post()['recaptcha_version'] : CHV\Settings::get('recaptcha_version')); ?>
						</select></div>
						<div class="input-below"><?php _se("Please note that each reCAPTCHA version require its own set of keys. Don't forget to update the keys if you change versions."); ?></div>
					</div>
					<div class="c9 phablet-c1">
						<div class="input-label">
							<label for="recaptcha_public_key"><?php _se('%s site key', 'reCAPTCHA'); ?></label>
							<input type="text" name="recaptcha_public_key" id="recaptcha_public_key" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['recaptcha_public_key'] : CHV\Settings::get('recaptcha_public_key', true); ?>">
							<div class="input-warning red-warning"><?php echo get_input_errors()['recaptcha_public_key']; ?></div>
						</div>
						<div class="input-label">
							<label for="recaptcha_private_key"><?php _se('%s secret key', 'reCAPTCHA'); ?></label>
							<input type="text" name="recaptcha_private_key" id="recaptcha_private_key" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['recaptcha_private_key'] : CHV\Settings::get('recaptcha_private_key', true); ?>">
							<div class="input-warning red-warning"><?php echo get_input_errors()['recaptcha_private_key']; ?></div>
						</div>
					</div>
					<div class="input-label">
						<div class="c9 phablet-c1">
							<label for="recaptcha_threshold"><?php _se('reCAPTCHA threshold'); ?></label>
							<div class="c2">
								<input type="number" min="0" name="recaptcha_threshold" id="recaptcha_threshold" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['recaptcha_threshold'] : CHV\Settings::get('recaptcha_threshold'); ?>">
							</div>
						</div>
						<div class="input-below"><?php _se('How many failed attempts are needed to ask for reCAPTCHA? Use zero (0) to always show reCAPTCHA.'); ?></div>
					</div>
					<div class="input-label">
						<label for="force_recaptcha_contact_page"><?php _se('Force %s on contact page', 'reCAPTCHA'); ?></label>
						<div class="c5 phablet-c1"><select type="text" name="force_recaptcha_contact_page" id="force_recaptcha_contact_page" class="text-input">
							<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['force_recaptcha_contact_page'] : CHV\Settings::get('force_recaptcha_contact_page')); ?>
						</select></div>
						<div class="input-below"><?php _se('Enable this to always show %s on contact page.', 'reCAPTCHA'); ?></div>
					</div>
				</div>
			</div>
			<hr class="line-separator">
			<div class="input-label">
				<label for="comments_api"><?php _se('Comments API'); ?></label>
				<div class="c5 phablet-c1"><select type="text" name="comments_api" id="comments_api" class="text-input" data-combo="comments_api-combo">
					<?php
                            echo CHV\Render\get_select_options_html([
                                'disqus' => 'Disqus',
                                'js' => 'JavaScript/HTML',
                            ], get_safe_post() ? get_safe_post()['comments_api'] : CHV\Settings::get('comments_api')); ?>
				</select></div>
				<div class="input-below"><?php _se('Disqus API works with %s.', '<a href="https://help.disqus.com/customer/portal/articles/236206" target="_blank">Single Sign-On</a> (SSO)'); ?></div>
			</div>
			<div id="comments_api-combo">
				<div data-combo-value="disqus" class="switch-combo<?php if ((get_safe_post() ? get_safe_post()['comments_api'] : CHV\Settings::get('comments_api')) !== 'disqus') {
                                echo ' soft-hidden';
                            } ?>">
					<div class="c9 phablet-c1">
						<div class="input-label">
							<label for="disqus_shortname"><?php _se('Disqus shortname'); ?></label>
							<input type="text" name="disqus_shortname" id="disqus_shortname" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['disqus_shortname'] : CHV\Settings::get('disqus_shortname', true); ?>">
							<div class="input-warning red-warning"><?php echo get_input_errors()['disqus_shortname']; ?></div>
						</div>
						<div class="input-label">
							<label for="disqus_secret_key"><?php _se('%s secret key', 'Disqus'); ?></label>
							<input type="text" name="disqus_secret_key" id="disqus_secret_key" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['disqus_secret_key'] : CHV\Settings::get('disqus_secret_key', true); ?>">
							<div class="input-warning red-warning"><?php echo get_input_errors()['disqus_secret_key']; ?></div>
						</div>
						<div class="input-label">
							<label for="disqus_public_key"><?php _se('%s public key', 'Disqus'); ?></label>
							<input type="text" name="disqus_public_key" id="disqus_public_key" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['disqus_public_key'] : CHV\Settings::get('disqus_public_key', true); ?>">
							<div class="input-warning red-warning"><?php echo get_input_errors()['disqus_public_key']; ?></div>
						</div>
					</div>
				</div>
				<div data-combo-value="js" class="switch-combo<?php if ((get_safe_post() ? get_safe_post()['comments_api'] : CHV\Settings::get('comments_api')) !== 'js') {
                                echo ' soft-hidden';
                            } ?>">
					<div class="input-label">
						<label for="comment_code"><?php _se('Comment code'); ?></label>
						<div class="c12 phablet-c1"><textarea type="text" name="comment_code" id="comment_code" class="text-input r4" value="" placeholder="<?php _se('Disqus, Facebook or anything you want. It will be used in image view.'); ?>"><?php echo CHV\Settings::get('comment_code', true); ?></textarea></div>
					</div>
                </div>
            </div>
            <hr class="line-separator"></hr>
            <div class="input-label">
                <label for="moderatecontent">ModerateContent</label>
                <div class="c5 phablet-c1"><select type="text" name="moderatecontent" id="moderatecontent" class="text-input" data-combo="moderatecontent-combo">
                    <?php
                        echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], get_safe_post() ? get_safe_post()['moderatecontent'] : CHV\Settings::get('moderatecontent')); ?>
                </select></div>
                <div class="input-below"><?php _se('Automatically moderate the content using the %s service.', '<a href="https://www.moderatecontent.com/" target="_blank">ModerateContent</a>'); ?></div>
            </div>
            <div id="moderatecontent-combo" class="c12 phablet-c1">
                <div data-combo-value="1" class="switch-combo<?php if ((get_safe_post() ? get_safe_post()['moderatecontent'] : CHV\Settings::get('moderatecontent')) == 0) {
                            echo ' soft-hidden';
                        } ?>">
                    <div class="input-label">
                        <label for="moderatecontent_key">ModerateContent API Key</label>
                        <input type="text" name="moderatecontent_key" id="moderatecontent_key" class="text-input" value="<?php echo get_safe_post() ? get_safe_post()['moderatecontent_key'] : CHV\Settings::get('moderatecontent_key'); ?>" placeholder="">
                        <div class="input-below input-warning red-warning"><?php echo get_input_errors()['moderatecontent_key']; ?></div>
                    </div>
                    <div class="input-label">
                        <label for="moderatecontent_auto_approve"><?php _se('Automatic approve'); ?></label>
                        <div class="c5 phablet-c1"><select type="text" name="moderatecontent_auto_approve" id="moderatecontent_auto_approve" class="text-input">
                        <?php echo CHV\Render\get_select_options_html([0 => _s('Disabled'), 1 => _s('Enabled')], get_safe_post() ? get_safe_post()['moderatecontent_auto_approve'] : CHV\Settings::get('moderatecontent_auto_approve')); ?>
                        </select></div>
                        <div class="input-below"><?php _se('Enable this to automatically approve content moderated by this service.'); ?></div>
                    </div>
                    <div class="input-label">
                        <label for="moderatecontent_block_rating"><?php _se('Block content'); ?></label>
                        <div class="c5 phablet-c1"><select type="text" name="moderatecontent_block_rating" id="moderatecontent_block_rating" class="text-input">
                        <?php echo CHV\Render\get_select_options_html(['' => _s('Disabled'), 'a' => _s('Adult'), 't' => _s('Teen and adult')], get_safe_post() ? get_safe_post()['moderatecontent_block_rating'] : CHV\Settings::get('moderatecontent_block_rating')); ?>
                        </select></div>
                    </div>
                    <div class="input-label">
                        <label for="moderatecontent_flag_nsfw"><?php _se('Flag NSFW'); ?></label>
                        <div class="c5 phablet-c1"><select type="text" name="moderatecontent_flag_nsfw" id="moderatecontent_flag_nsfw" class="text-input">
                        <?php echo CHV\Render\get_select_options_html([0 => _s('Disabled'), 'a' => _s('Adult'), 't' => _s('Teen and adult')], get_safe_post() ? get_safe_post()['moderatecontent_flag_nsfw'] : CHV\Settings::get('moderatecontent_flag_nsfw')); ?>
                        </select></div>
                    </div>                    
                </div>
            </div>
            <hr class="line-separator">
            <div class="input-label">
                <label for="analytics_code"><?php _se('Analytics code'); ?></label>
                <div class="c12 phablet-c1"><textarea type="text" name="analytics_code" id="analytics_code" class="text-input r4" value="" placeholder="<?php _se('Google Analytics or anything you want. It will be added to the theme footer.'); ?>"><?php echo CHV\Settings::get('analytics_code', true); ?></textarea></div>
            </div>
<?php
                        } ?>

<?php if (get_settings()['key'] == 'api') {
                            ?>
	<p><?php echo read_the_docs_settings('api', _s('api')); ?></p>
	<div class="input-label">
		<label for="api_v1_key"><?php _se('API v1 key'); ?></label>
		<div class="c9 phablet-c1"><input type="text" name="api_v1_key" id="api_v1_key" class="text-input" value="<?php echo CHV\Settings::get('api_v1_key', true); ?>"></div>
		<div class="input-warning red-warning"><?php echo get_input_errors()['api_v1_key']; ?></div>
		<div class="input-below"><?php _se('Use this key when using the <a %s>API v1</a>.', 'href="http://bit.ly/1F8s9sX" target="_blank"'); ?></div>
	</div>
<?php
                        } ?>

<?php if (get_settings()['key'] == 'additional-settings') {
                            ?>
    <p><?php echo read_the_docs_settings('additional-settings', _s('additional settings')); ?></p>
	<div class="input-label">
		<label for="enable_plugin_route"><?php _se('Plugin route'); ?></label>
		<div class="c5 phablet-c1"><select type="text" name="enable_plugin_route" id="enable_plugin_route" class="text-input">
				<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_plugin_route')); ?>
			</select></div>
		<div class="input-below"><?php _se("Enable this to display plugin instructions at %u. A link to these instructions will be added to the %s menu. This setting doesn't affect administrators.", [
                                                                '%u' => G_ROOT_PATH_RELATIVE . 'plugin',
                                                                '%s' => '“' . _s('About') . '”',
                                                            ]); ?></div>
	</div>
	<div class="input-label">
		<label for="sdk_pup_url">PUP SDK URL</label>
		<div class="c9 phablet-c1"><input type="text" name="sdk_pup_url" id="sdk_pup_url" class="text-input" value="<?php echo CHV\Settings::get('sdk_pup_url', true); ?>" placeholder="<?php _se('Empty'); ?>"></div>
		<div class="input-below input-warning red-warning"><?php echo get_input_errors()['sdk_pup_url']; ?></div>
		<div class="input-below"><?php _se('Use this to set a custom URL for %p. Please note that you need to manually replicate %s in this URL.', ['%p' => 'PUP SDK', '%s' => G_ROOT_PATH_RELATIVE . 'sdk/pup.js']); ?></div>
	</div>

	<hr class="line-separator">

	<div class="input-label">
		<label for="enable_cookie_law"><?php _se('Cookie law compliance'); ?></label>
		<div class="c5 phablet-c1"><select type="text" name="enable_cookie_law" id="enable_cookie_law" class="text-input">
				<?php
                            echo CHV\Render\get_select_options_html([1 => _s('Enabled'), 0 => _s('Disabled')], CHV\Settings::get('enable_cookie_law')); ?>
			</select></div>
		<div class="input-below"><?php _se('Enable this to display a message that complies with the EU Cookie law requirements. Note: You only need this if your website is hosted in the EU and if you add tracking cookies.'); ?></div>
	</div>
<?php
                        } ?>

<?php
                        if (is_show_submit()) {
                            ?>

	<div class="btn-container btn-container--fixed">
		<div class="content-width">
			<button class="btn btn-input red" type="submit"><?php _se('Save changes'); ?></button>
		</div>
	</div>
<?php
                        } ?>

<?php
                    }
?>

</form>
<?php
                break;
        }
?>

</div>

</div>

<?php if (is_changed() || is_error()) {
    ?>
	<script>
		$(function() {
			PF.fn.growl.expirable("<?php echo is_changed() ? (get_changed_message() ?: _s('Changes have been saved.')) : (get_error_message() ?: _s('Check the errors to proceed.')); ?>");
		});
	</script>
<?php
} ?>

<?php G\Render\include_theme_footer(); ?>
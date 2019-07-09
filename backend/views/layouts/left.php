<aside class="main-sidebar">

  <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>

        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
      </div>
    </form>
    <!-- /.search form -->

    <?= dmstr\widgets\Menu::widget(
      [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
        'items' => [
          // ['label' => '管理员', 'options' => ['class' => 'header']], 下拉选项
          ['label' => '管理员', 'icon' => 'user-secret',
            'url' => ['adminuser/index']
          ],
          ['label' => '文章管理', 'icon' => 'file-word-o',
            'url' => ['post/index'],
          ],
          ['label' => '评论管理', 'icon' => 'file-word-o',
            'url' => ['comment/index'],
          ],
          ['label' => '用户管理', 'icon' => 'file-word-o',
            'url' => ['user/index'],
          ],
          ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
          ['label' => '登录', 'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest],

          [
            'label' => '权限管理',
            'icon' => 'unlock-alt',
            'url' => '#',
            'items' => [
              ['label' => '路由', 'icon' => 'road', 'url' => ['/admin/route'],],
              ['label' => '权限', 'icon' => 'certificate', 'url' => ['/admin/permission'],],
              ['label' => '角色', 'icon' => 'user', 'url' => ['/admin/role'],],
              ['label' => '分配', 'icon' => 'check-circle', 'url' => ['/admin/assignment'],],
              ['label' => '菜单', 'icon' => 'list-alt', 'url' => ['/admin/menu'],],
            ],
          ],

          [
            'label' => '系统工具',
            'icon' => 'share',
            'url' => '#',
            'items' => [
              ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
              ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
              [
                'label' => 'Level One',
                'icon' => 'circle-o',
                'url' => '#',
                'items' => [
                  ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                  [
                    'label' => 'Level Two',
                    'icon' => 'circle-o',
                    'url' => '#',
                    'items' => [
                      ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                      ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    ],
                  ],
                ],
              ],
            ],
          ],
        ],
      ]
    ) ?>

  </section>

</aside>

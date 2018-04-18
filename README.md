# Siswa

[![Join the chat at https://gitter.im/siswa/Lobby](https://badges.gitter.im/siswa/Lobby.svg)](https://gitter.im/siswa/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/siswa/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/siswa/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/siswa/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/siswa/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/siswa/v/stable)](https://packagist.org/packages/bantenprov/siswa)
[![Total Downloads](https://poser.pugx.org/bantenprov/siswa/downloads)](https://packagist.org/packages/bantenprov/siswa)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/siswa/v/unstable)](https://packagist.org/packages/bantenprov/siswa)
[![License](https://poser.pugx.org/bantenprov/siswa/license)](https://packagist.org/packages/bantenprov/siswa)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/siswa/d/monthly)](https://packagist.org/packages/bantenprov/siswa)
[![Daily Downloads](https://poser.pugx.org/bantenprov/siswa/d/daily)](https://packagist.org/packages/bantenprov/siswa)

Siswa

### Install via composer

- Development snapshot

```bash
$ composer require bantenprov/siswa:dev-master
```

- Latest release:

```bash
$ composer require bantenprov/siswa
```

### Download via github

```bash
$ git clone https://github.com/bantenprov/siswa.git
```

#### Edit `config/app.php` :

```php
'providers' => [

    /*
    * Laravel Framework Service Providers...
    */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    //...
    Bantenprov\Siswa\SiswaServiceProvider::class,
    //...
```

#### Lakukan migrate :

```bash
$ php artisan migrate
```

#### Lakukan publish semua komponen :

```bash
$ php artisan vendor:publish --tag=siswa-publish
```

#### Lakukan auto dump :

```bash
$ composer dump-autoload
```

#### Lakukan seeding :

```bash
$ php artisan db:seed --class=BantenprovSiswaSeeder
```

#### Tambahkan route di dalam file : `resources/assets/js/routes.js` :

```javascript
{
    path: '/dashboard',
    redirect: '/dashboard/home',
    component: layout('Default'),
    children: [
        //...
        {
            path: '/dashboard/siswa',
            components: {
                main: resolve => require(['./components/views/bantenprov/siswa/DashboardSiswa.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Siswa"
            }
        },
        //...
    ]
},
```

```javascript
{
    path: '/admin',
    redirect: '/admin/dashboard/home',
    component: layout('Default'),
    children: [
        //...
        {
            path: '/admin/siswa',
            components: {
                main: resolve => require(['./components/bantenprov/siswa/Siswa.index.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Siswa"
            }
        },
        {
            path: '/admin/siswa/create',
            components: {
                main: resolve => require(['./components/bantenprov/siswa/Siswa.add.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Add Siswa"
            }
        },
        {
            path: '/admin/siswa/:id',
            components: {
                main: resolve => require(['./components/bantenprov/siswa/Siswa.show.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "View Siswa"
            }
        },
        {
            path: '/admin/siswa/:id/edit',
            components: {
                main: resolve => require(['./components/bantenprov/siswa/Siswa.edit.vue'], resolve),
                navbar: resolve => require(['./components/Navbar.vue'], resolve),
                sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
            },
            meta: {
                title: "Edit Siswa"
            }
        },
        //...
    ]
},
```

#### Edit menu `resources/assets/js/menu.js`

```javascript
{
    name: 'Dashboard',
    icon: 'fa fa-dashboard',
    childType: 'collapse',
    childItem: [
        //...
        {
            name: 'Siswa',
            link: '/dashboard/siswa',
            icon: 'fa fa-angle-double-right'
        },
        //...
    ]
},
```

```javascript
{
    name: 'Admin',
    icon: 'fa fa-lock',
    childType: 'collapse',
    childItem: [
        //...
        {
            name: 'Siswa',
            link: '/admin/siswa',
            icon: 'fa fa-angle-double-right'
        },
        //...
    ]
},
```

#### Tambahkan components `resources/assets/js/components.js` :

```javascript
//... Siswa ...//

import Siswa from './components/bantenprov/siswa/Siswa.chart.vue';
Vue.component('echarts-siswa', Siswa);

import SiswaKota from './components/bantenprov/siswa/SiswaKota.chart.vue';
Vue.component('echarts-siswa-kota', SiswaKota);

import SiswaTahun from './components/bantenprov/siswa/SiswaTahun.chart.vue';
Vue.component('echarts-siswa-tahun', SiswaTahun);

import SiswaAdminShow from './components/bantenprov/siswa/SiswaAdmin.show.vue';
Vue.component('admin-view-siswa-tahun', SiswaAdminShow);

//... Echarts Siswa ...//

import SiswaBar01 from './components/views/bantenprov/siswa/SiswaBar01.vue';
Vue.component('siswa-bar-01', SiswaBar01);

import SiswaBar02 from './components/views/bantenprov/siswa/SiswaBar02.vue';
Vue.component('siswa-bar-02', SiswaBar02);

//... mini bar charts ...//
import SiswaBar03 from './components/views/bantenprov/siswa/SiswaBar03.vue';
Vue.component('siswa-bar-03', SiswaBar03);

import SiswaPie01 from './components/views/bantenprov/siswa/SiswaPie01.vue';
Vue.component('siswa-pie-01', SiswaPie01);

import SiswaPie02 from './components/views/bantenprov/siswa/SiswaPie02.vue';
Vue.component('siswa-pie-02', SiswaPie02);

//... Mini Pie Charts ...//

import SiswaPie03 from './components/views/bantenprov/siswa/SiswaPie03.vue';
Vue.component('siswa-pie-03', SiswaPie03);
```

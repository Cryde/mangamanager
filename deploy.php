<?php

namespace Deployer;

require 'recipe/symfony4.php';
require 'vendor/deployer/recipes/recipe/npm.php';

// Project repository
set('repository', 'git@github.com:Cryde/mangamanager.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);
set('keep_releases', 1);
set('ssh_multiplexing', true);

add('shared_files', ['.env.local']);
add('shared_dirs', [
    'public/cover/book',
    'public/cover/tome',
]);

// Hosts
inventory('hosts.yml');

// Tasks
task('npm:ci', function () {
    run("cd {{release_path}} && {{bin/npm}} ci");
});
desc('Build assets');
task(
    'assets:build',
    function () {
        run('cd {{release_path}} && {{bin/npm}} run build');
    }
);
after('npm:ci', 'assets:build');

desc('Remove node_modules folder');
task(
    'assets:clean',
    function () {
        run('cd {{release_path}} && rm -rf node_modules');
    }
);
after('deploy:symlink', 'assets:clean');

desc('Restart PHP-FPM service');
task(
    'php-fpm:restart',
    function () {
        run('sudo service php7.3-fpm reload');
    }
);
after('deploy:symlink', 'php-fpm:restart');

// Migrate database before symlink new release.
before('deploy:symlink', 'database:migrate');
after('deploy:update_code', 'npm:ci');

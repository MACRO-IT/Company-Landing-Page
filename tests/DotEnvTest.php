<?php

require_once './vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 1));
$dotenv->load();
it('asserts DotEnv is working Fine', function () {
    // Prepare
    $mail_username = 'test_mail_username';

    // Act
    $dot_env_mail_username = $_ENV['MAIL_USERNAME'];

    // Assert
    expect($mail_username)->toEqual($dot_env_mail_username);
});
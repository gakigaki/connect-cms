@echo off
chcp 932

rem ----------------------------------------------
rem bat�ł܂Ƃ߂ăe�X�g���s
rem > tests\bin\connect-cms-test.bat
rem
rem [How to test]
rem https://github.com/opensource-workshop/connect-cms/wiki/Dusk
rem ----------------------------------------------

@php artisan config:clear

if "%1" == "db_clear" (
    echo.
    echo --- �L���b�V���N���A
    php artisan cache:clear
    php artisan config:clear

    echo.
    echo --- �f�[�^�x�[�X�E�N���A
    php artisan migrate:fresh --env=testing

    echo.
    echo --- �f�[�^�E�����ǉ�
    php artisan db:seed --env=testing
)

rem ---------------------------------------------
rem - �R�A
rem ---------------------------------------------

echo.
echo --- �y�[�W�Ȃ�
rem php artisan dusk tests\Browser\Core\PageNotFoundTest.php --env=testing

rem ---------------------------------------------
rem - �Ǘ��v���O�C��
rem ---------------------------------------------

echo.
echo --- �Ǘ���ʃA�N�Z�X
rem php artisan dusk tests\Browser\Manage\IndexManageTest.php --env=testing

echo.
echo --- �y�[�W�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\PageManageTest.php --env=testing

echo.
echo --- �T�C�g�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\SiteManageTest.php --env=testing

echo.
echo --- ���[�U�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\UserManageTest.php --env=testing

echo.
echo --- �O���[�v�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\GroupManageTest.php --env=testing

echo.
echo --- �Z�L�����e�B�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\SecurityManageTest.php --env=testing

echo.
echo --- �v���O�C���Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\PluginManageTest.php --env=testing

echo.
echo --- �V�X�e���Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\SystemManageTest.php --env=testing

echo.
echo --- API�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\ApiManageTest.php --env=testing

echo.
echo --- ���b�Z�[�W�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\MessageManageTest.php --env=testing

echo.
echo --- �O���F�؊Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\AuthManageTest.php --env=testing

rem ---------------------------------------------
rem - ��ʃv���O�C��
rem ---------------------------------------------

echo.
echo --- �w�b�_�[
php artisan dusk tests\Browser\User\HeaderAreaTest.php --env=testing

echo.
echo �� �X�N���[���V���b�g�̕ۑ���
echo tests\Browser\screenshots

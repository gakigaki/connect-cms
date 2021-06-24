chcp 932
@echo off

rem ----------------------------------------------
rem [How to test]
rem �J�����C�u���� dusk ���C���X�g�[��
rem composer install
rem
rem �N���[���h���C�o�[���C���X�g�[��
rem php artisan dusk:chrome-driver
rem
rem �e�X�gDB�̍쐬���āA.env�ύX�i�e�X�g���s����ƁA�f�[�^�ǉ�������A�I�v�V���� db_clear ��DB�N���A�o�����肷�邽�߁j
rem #DB_DATABASE=cms
rem DB_DATABASE=cms_test
rem
rem �e�X�g�R�[�h�̎��s
rem tests\bin\connect-cms-test.bat
rem tests\bin\connect-cms-test.bat db_clear   �� ����͂�����
rem
rem �� �X�N���[���V���b�g�̕ۑ���
rem tests\Browser\screenshots
rem ----------------------------------------------

@php artisan config:clear

if "%1" == "db_clear" (
    echo.
    echo --- �L���b�V���N���A
    php artisan cache:clear
    php artisan config:clear

    echo.
    echo --- �f�[�^�x�[�X�E�N���A
    php artisan migrate:fresh

    echo.
    echo --- �f�[�^�E�����ǉ�
    php artisan db:seed
)

rem ---------------------------------------------
rem - �Ǘ��v���O�C��
rem ---------------------------------------------

echo.
echo --- �Ǘ���ʃA�N�Z�X
rem php artisan dusk tests\Browser\Manage\IndexManage.php

echo.
echo --- �y�[�W�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\PageManage.php

echo.
echo --- �T�C�g�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\SiteManage.php

echo.
echo --- ���[�U�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\UserManage.php

echo.
echo --- �O���[�v�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\GroupManage.php

echo.
echo --- �Z�L�����e�B�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\SecurityManage.php

echo.
echo --- �v���O�C���Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\PluginManage.php

echo.
echo --- �V�X�e���Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\SystemManage.php

echo.
echo --- API�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\ApiManage.php

echo.
echo --- ���b�Z�[�W�Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\MessageManage.php

echo.
echo --- �O���F�؊Ǘ��̃e�X�g
rem php artisan dusk tests\Browser\Manage\AuthManage.php

rem ---------------------------------------------
rem - ��ʃv���O�C��
rem ---------------------------------------------

echo.
echo --- �w�b�_�[
php artisan dusk tests\Browser\User\HeaderArea.php


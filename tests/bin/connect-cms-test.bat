@echo off
chcp 932

rem ----------------------------------------------
rem bat�ł܂Ƃ߂ăe�X�g���s
rem > tests\bin\connect-cms-test.bat
rem
rem > tests\bin\connect-cms-test.bat trancate  <<-- �f�[�^�̃N���A���V�[�_�[
rem > tests\bin\connect-cms-test.bat fresh     <<-- �e�[�u���̍č\�z���V�[�_�[
rem
rem �}�j���A���o��
rem > php artisan dusk tests\Manual\src\ManualOutput.php
rem > php artisan dusk tests\Manual\src\ManualPdf.php
rem
rem [How to test]
rem https://github.com/opensource-workshop/connect-cms/wiki/Dusk
rem ----------------------------------------------

if exist .env.dusk.local (
    echo .env.dusk.local �Ŏ��s���܂��B
) else (
    echo .env.dusk.local �����݂��Ȃ����߁A�e�X�g�����s�����ɏI�����܂��B
    exit /b
)

rem �e�X�g�R�}���h���s���ɂP�x�����A�����e�X�gDB������������̂ŕs�v�ł��B
rem   (see) https://github.com/opensource-workshop/connect-cms/wiki/Dusk#�蓮�Ńe�X�gdb������
rem @php artisan config:clear

if "%1" == "trancate" (
    rem ���L�́A�����e�X�gDB�������ōs���Ă��Ȃ��R�}���h
    rem echo.
    rem echo --- �L���b�V���N���A
    rem php artisan cache:clear
    rem php artisan config:clear

    echo.
    echo --- �f�[�^�x�[�X�E�N���A
    php artisan db:seed --env=dusk.local --class=TruncateAllTables

    echo.
    echo --- �f�[�^�E�����ǉ�
    php artisan db:seed --env=dusk.local
)

if "%1" == "fresh" (
    rem ���L�́A�����e�X�gDB�������ōs���Ă��Ȃ��R�}���h
    rem echo.
    rem echo --- �L���b�V���N���A
    rem php artisan cache:clear
    rem php artisan config:clear

    echo.
    echo --- �e�[�u���̍č\�z
    php artisan migrate:fresh --env=dusk.local

    echo.
    echo --- �f�[�^�E�����ǉ�
    php artisan db:seed --env=dusk.local
)

rem ---------------------------------------------
rem - ���O�����p�̎��s
rem ---------------------------------------------

echo.
echo --- �f�[�^�����p - ���O�Ǘ� - �}�j���A���Ȃ�
php artisan dusk tests\Browser\Manage\LogManageTest.php no_manual

rem ---------------------------------------------
rem - �Ǘ��v���O�C��
rem ---------------------------------------------

echo.
echo --- �Ǘ���ʃA�N�Z�X
php artisan dusk tests\Browser\Manage\IndexManageTest.php

echo.
echo --- �y�[�W�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\PageManageTest.php

echo.
echo --- �T�C�g�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\SiteManageTest.php

echo.
echo --- ���[�U�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\UserManageTest.php

echo.
echo --- �O���[�v�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\GroupManageTest.php

echo.
echo --- �Z�L�����e�B�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\SecurityManageTest.php

echo.
echo --- �v���O�C���Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\PluginManageTest.php

echo.
echo --- �V�X�e���Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\SystemManageTest.php

echo.
echo --- API�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\ApiManageTest.php

echo.
echo --- ���b�Z�[�W�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\MessageManageTest.php

echo.
echo --- �O���F�؊Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\AuthManageTest.php

echo.
echo --- �O���T�[�r�X�ݒ�̃e�X�g
php artisan dusk tests\Browser\Manage\ServiceManageTest.php

rem ---------------------------------------------
rem - �f�[�^�Ǘ��v���O�C��
rem ---------------------------------------------

echo.
echo --- �A�b�v���[�h�t�@�C��
php artisan dusk tests\Browser\Manage\UploadfileManageTest.php

echo.
echo --- �e�[�}�Ǘ�
php artisan dusk tests\Browser\Manage\ThemeManageTest.php

echo.
echo --- �A�ԊǗ�
php artisan dusk tests\Browser\Manage\NumberManageTest.php

echo.
echo --- �R�[�h�Ǘ�
php artisan dusk tests\Browser\Manage\CodeManageTest.php

echo.
echo --- ���O�Ǘ�
php artisan dusk tests\Browser\Manage\LogManageTest.php

echo.
echo --- �j���Ǘ�
php artisan dusk tests\Browser\Manage\HolidayManageTest.php

echo.
echo --- ���V�X�e���ڍs
php artisan dusk tests\Browser\Manage\MigrationManageTest.php

rem ---------------------------------------------
rem - �R�A
rem ---------------------------------------------

echo.
echo --- �y�[�W�Ȃ�(404)
rem php artisan dusk tests\Browser\Core\PageNotFoundTest.php

echo.
echo --- �����Ȃ�(403)
rem php artisan dusk tests\Browser\Core\PageForbiddenTest.php

echo.
echo --- ����m�F���b�Z�[�W����e�X�g
rem php artisan dusk tests\Browser\Core\MessageFirstShowTest.php

echo.
echo --- ����m�F���b�Z�[�W����e�X�g ���ڃt������
rem php artisan dusk tests\Browser\Core\MessageFirstShowFullTest.php

echo.
echo --- �{���p�X���[�h�t�y�[�W�e�X�g
rem php artisan dusk tests\Browser\Core\PagePasswordTest.php

echo.
echo --- ���O�C���e�X�g
rem php artisan dusk tests\Browser\Core\LoginTest.php

rem ---------------------------------------------
rem - ����
rem ---------------------------------------------

echo.
echo --- ���O�C���E���O�A�E�g
php artisan dusk tests\Browser\Common\LoginLogoutTest.php

echo.
echo --- �Ǘ��@�\
php artisan dusk tests\Browser\Common\AdminLinkTest.php

rem ---------------------------------------------
rem - ��ʃv���O�C��
rem ---------------------------------------------

echo.
echo --- �u���O
rem php artisan dusk tests\Browser\User\BlogTest.php

echo.
echo �� �X�N���[���V���b�g�̕ۑ���
echo tests\Browser\screenshots

rem ---------------------------------------------
rem - �}�j���A��
rem ---------------------------------------------




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
    rem echo --- �L���b�V���N���A
    rem php artisan cache:clear
    rem php artisan config:clear

    echo --- �f�[�^�x�[�X�E�N���A
    php artisan db:seed --env=dusk.local --class=TruncateAllTables

    echo --- �f�[�^�E�����ǉ�
    php artisan db:seed --env=dusk.local
)

if "%1" == "fresh" (
    rem ���L�́A�����e�X�gDB�������ōs���Ă��Ȃ��R�}���h
    rem echo --- �L���b�V���N���A
    rem php artisan cache:clear
    rem php artisan config:clear

    echo --- �e�[�u���̍č\�z
    php artisan migrate:fresh --env=dusk.local

    echo --- �f�[�^�E�����ǉ�
    php artisan db:seed --env=dusk.local
)

rem ---------------------------------------------
rem - ���O�����p�̎��s
rem ---------------------------------------------

echo --- �f�[�^�����p - ���O�Ǘ� - �}�j���A���Ȃ�
php artisan dusk tests\Browser\Manage\LogManageTest.php no_manual

rem ---------------------------------------------
rem - �Ǘ��v���O�C��
rem ---------------------------------------------

echo --- �Ǘ���ʃA�N�Z�X
php artisan dusk tests\Browser\Manage\IndexManageTest.php

echo --- �y�[�W�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\PageManageTest.php

echo --- �T�C�g�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\SiteManageTest.php

echo --- ���[�U�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\UserManageTest.php

echo --- �O���[�v�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\GroupManageTest.php

echo --- �Z�L�����e�B�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\SecurityManageTest.php

echo --- �v���O�C���Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\PluginManageTest.php

echo --- �V�X�e���Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\SystemManageTest.php

echo --- API�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\ApiManageTest.php

echo --- ���b�Z�[�W�Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\MessageManageTest.php

echo --- �O���F�؊Ǘ��̃e�X�g
php artisan dusk tests\Browser\Manage\AuthManageTest.php

echo --- �O���T�[�r�X�ݒ�̃e�X�g
php artisan dusk tests\Browser\Manage\ServiceManageTest.php

rem ---------------------------------------------
rem - �f�[�^�Ǘ��v���O�C��
rem ---------------------------------------------

echo --- �A�b�v���[�h�t�@�C��
php artisan dusk tests\Browser\Manage\UploadfileManageTest.php

echo --- �e�[�}�Ǘ�
php artisan dusk tests\Browser\Manage\ThemeManageTest.php

echo --- �A�ԊǗ�
php artisan dusk tests\Browser\Manage\NumberManageTest.php

echo --- �R�[�h�Ǘ�
php artisan dusk tests\Browser\Manage\CodeManageTest.php

echo --- ���O�Ǘ�
php artisan dusk tests\Browser\Manage\LogManageTest.php

echo --- �j���Ǘ�
php artisan dusk tests\Browser\Manage\HolidayManageTest.php

echo --- ���V�X�e���ڍs
php artisan dusk tests\Browser\Manage\MigrationManageTest.php

rem ---------------------------------------------
rem - �R�A
rem ---------------------------------------------

echo --- �y�[�W�Ȃ�(404)
rem php artisan dusk tests\Browser\Core\PageNotFoundTest.php

echo --- �����Ȃ�(403)
rem php artisan dusk tests\Browser\Core\PageForbiddenTest.php

echo --- ����m�F���b�Z�[�W����e�X�g
rem php artisan dusk tests\Browser\Core\MessageFirstShowTest.php

echo --- ����m�F���b�Z�[�W����e�X�g ���ڃt������
rem php artisan dusk tests\Browser\Core\MessageFirstShowFullTest.php

echo --- �{���p�X���[�h�t�y�[�W�e�X�g
rem php artisan dusk tests\Browser\Core\PagePasswordTest.php

echo --- ���O�C���e�X�g
rem php artisan dusk tests\Browser\Core\LoginTest.php

rem ---------------------------------------------
rem - ����
rem ---------------------------------------------

echo --- ���O�C���E���O�A�E�g
php artisan dusk tests\Browser\Common\LoginLogoutTest.php

echo --- �Ǘ��@�\
php artisan dusk tests\Browser\Common\AdminLinkTest.php

rem ---------------------------------------------
rem - ��ʃv���O�C��
rem ---------------------------------------------

echo --- �Œ�L��
php artisan dusk tests\Browser\User\ContentsPluginTest.php

echo --- ���j���[
php artisan dusk tests\Browser\User\MenusPluginTest.php

echo --- �u���O
php artisan dusk tests\Browser\User\BlogsPluginTest.php

echo --- �J�����_�[
php artisan dusk tests\Browser\User\CalendarsPluginTest.php

echo --- �X���C�h�V���[
php artisan dusk tests\Browser\User\SlideshowsPluginTest.php

echo --- �J�كJ�����_�[
php artisan dusk tests\Browser\User\OpeningcalendarsPluginTest.php

echo --- �V�����
php artisan dusk tests\Browser\User\WhatsnewsPluginTest.php

echo --- FAQ
php artisan dusk tests\Browser\User\FaqsPluginTest.php

echo --- �����N���X�g
php artisan dusk tests\Browser\User\LinklistsPluginTest.php

echo --- �L���r�l�b�g
php artisan dusk tests\Browser\User\CabinetsPluginTest.php

echo --- �t�H�g�A���o��
php artisan dusk tests\Browser\User\PhotoalbumsPluginTest.php

echo --- �f�[�^�x�[�X
rem php artisan dusk tests\Browser\User\DatabasesPluginTest.php

echo �� �X�N���[���V���b�g�̕ۑ���
echo tests\Browser\screenshots

rem ---------------------------------------------
rem - �}�j���A��
rem ---------------------------------------------

rem �y���̔��M�z �Œ�L��, �u���O, �J�����_�[, �X���C�h�V���[, �J�كJ�����_�[, �V�����
rem �y���̒~�ρz FAQ, �����N���X�g, �L���r�l�b�g, �t�H�g�A���o��, �f�[�^�x�[�X, OPAC, (researchmap�A�g), (�@�փ��|�W�g��)
rem �y���̎��W�z �t�H�[��, �ۑ�Ǘ�, (�f�[�^���W)
rem �y���̌����z �T�C�g������, �f�[�^�x�[�X����
rem �y���̌����z �f����, �{�ݗ\��
rem �y���̐����z ���j���[, �^�u
rem �y���̎��s�z �e�[�}�`�F���W���[
rem �y���̋���z (DroneStudy), (CodeStudy)


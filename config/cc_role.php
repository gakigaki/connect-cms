<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Role
    |--------------------------------------------------------------------------
    |
    | Connect-CMS role const
    |
    */

    'ROLE_SYSTEM_MANAGER'    => 1,  // �V�X�e���Ǘ���
    'ROLE_SITE_MANAGER'      => 2,  // �T�C�g�Ǘ���
    'ROLE_USER_MANAGER'      => 3,  // ���[�U�Ǘ���
    'ROLE_PAGE_MANAGER'      => 4,  // �y�[�W�Ǘ���
    'ROLE_OPERATION_MANAGER' => 5,  // �^�p�Ǘ���
    'ROLE_APPROVER'          => 10, // ���F��
    'ROLE_EDITOR'            => 11, // �ҏW��
    'ROLE_MODERATOR'         => 12, // ���f���[�^
    'ROLE_GENERAL'           => 13, // ���
    'ROLE_GUEST'             => 0,  // �Q�X�g

    /*
    |--------------------------------------------------------------------------
    | Authority
    |--------------------------------------------------------------------------
    |
    | Connect-CMS authority const
    |
    */

    'CC_AUTHORITY' => [
        // �o�P�c
        'buckets.create'   => ['role_arrangement', 'role_article_admin', 'admin_system'],

        // �L��
        'posts.create'   => ['role_reporter', 'role_article', 'admin_system'],
        'posts.update'   => ['role_reporter', 'role_article', 'admin_system'],
        'posts.delete'   => ['role_reporter', 'role_article', 'admin_system'],
        'posts.approval' => ['role_approval', 'admin_system'],
    ],

];

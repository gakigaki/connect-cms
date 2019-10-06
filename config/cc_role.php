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

        // �t���[��
        'frames.create'   => ['role_arrangement', 'role_article_admin'],
        'frames.move'     => ['role_arrangement', 'role_article_admin'],
        'frames.edit'     => ['role_arrangement', 'role_article_admin'],
        'frames.delete'   => ['role_arrangement', 'role_article_admin'],
        'frames.change'   => ['role_arrangement', 'role_article_admin'],

        // �o�P�c
        'buckets.create'  => ['role_arrangement', 'role_article_admin'],

        // �L��
        'posts.create'   => ['role_reporter', 'role_article', 'role_article_admin'],
        'posts.update'   => ['role_reporter', 'role_article', 'role_article_admin'],
        'posts.delete'   => ['role_reporter', 'role_article', 'role_article_admin'],
        'posts.approval' => ['role_approval', 'role_article_admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Method Authority Check
    |--------------------------------------------------------------------------
    |
    | Connect-CMS method authority check const
    |
    */

    'CC_METHOD_AUTHORITY' => [

        // �L���i�����������w�肳��Ă���ꍇ�́A�A���h�����j
        'create'         => ['posts.create'],
        'edit'           => ['posts.update'],
        'store'          => ['posts.create'],
        'update'         => ['posts.update'],
        'save'           => ['posts.create', 'posts.update'],
        'temporarysave'  => ['posts.create', 'posts.update'],
        'delete'         => ['posts.delete'],
        'destroy'        => ['posts.delete'],
        'listBuckets'    => ['frames.change'],
        'createBuckets'  => ['frames.create'],
        'editBuckets'    => ['frames.edit'],
        'saveBuckets'    => ['frames.create'],
        'destroyBuckets' => ['frames.delete'],
        'changeBuckets'  => ['frames.change'],
    ],

];

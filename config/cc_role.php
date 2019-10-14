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
/*
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
*/
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
        'frames.create'              => ['role_arrangement', 'role_article_admin'],
        'frames.move'                => ['role_arrangement', 'role_article_admin'],
        'frames.edit'                => ['role_arrangement', 'role_article_admin'],
        'frames.delete'              => ['role_arrangement', 'role_article_admin'],
        'frames.change'              => ['role_arrangement', 'role_article_admin'],

        // �o�P�c
        'buckets.create'             => ['role_arrangement', 'role_article_admin'],
        'buckets.delete'             => ['role_arrangement', 'role_article_admin'],
        'buckets.addColumn'          => ['role_arrangement', 'role_article_admin'],
        'buckets.editColumn'         => ['role_arrangement', 'role_article_admin'],
        'buckets.deleteColumn'       => ['role_arrangement', 'role_article_admin'],
        'buckets.reloadColumn'       => ['role_arrangement', 'role_article_admin'],
        'buckets.upColumnSequence'   => ['role_arrangement', 'role_article_admin'],
        'buckets.downColumnSequence' => ['role_arrangement', 'role_article_admin'],
        'buckets.saveColumn'         => ['role_arrangement', 'role_article_admin'],
        'buckets.downloadCsv'        => ['role_arrangement', 'role_article_admin'],

        // �L��
        'posts.create'               => ['role_reporter', 'role_article', 'role_article_admin'],
        'posts.update'               => ['role_reporter', 'role_article', 'role_article_admin'],
        'posts.delete'               => ['role_reporter', 'role_article', 'role_article_admin'],
        'posts.approval'             => ['role_approval', 'role_article_admin'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Role Hierarchy
    |--------------------------------------------------------------------------
    |
    | Connect-CMS Role Hierarchy const
    |
    */

    'CC_ROLE_HIERARCHY' => [

        'role_reporter'     => ['role_reporter', 'role_article_admin'],
        'role_arrangement'  => ['role_arrangement', 'role_article_admin'],
        'role_approval'     => ['role_approval', 'role_article_admin'],
        'role_article'      => ['role_article', 'role_article_admin'],
        'role_article_admin'=> ['role_article_admin'],

        'admin_system'      => ['admin_system'],
        'admin_page'        => ['admin_page', 'admin_system'],
        'admin_site'        => ['admin_site', 'admin_system'],
        'admin_user'        => ['admin_user', 'admin_system'],
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
        'create'              => ['posts.create'],
        'edit'                => ['posts.update'],
        'store'               => ['posts.create'],
        'update'              => ['posts.update'],
        'save'                => ['posts.create', 'posts.update'],
        'temporarysave'       => ['posts.create', 'posts.update'],
        'delete'              => ['posts.delete'],
        'destroy'             => ['posts.delete'],
        'approval'            => ['posts.approval'],

        // �o�P�c���t���[��
        'listBuckets'         => ['frames.change'],
        'createBuckets'       => ['frames.create'],
        'editBuckets'         => ['frames.edit'],
        'saveBuckets'         => ['frames.create'],
        'destroyBuckets'      => ['frames.delete'],
        'changeBuckets'       => ['frames.change'],

        'addColumn'           => ['buckets.addColumn'],
        'editColumn'          => ['buckets.editColumn'],
        'deleteColumn'        => ['buckets.deleteColumn'],
        'reloadColumn'        => ['buckets.reloadColumn'],
        'upColumnSequence'    => ['buckets.upColumnSequence'],
        'downColumnSequence'  => ['buckets.downColumnSequence'],
        'saveColumn'          => ['buckets.saveColumn'],
        'downloadCsv'         => ['buckets.downloadCsv'],
    ],

    'CC_METHOD_REQUEST_METHOD' => [

        // �L���i�����������w�肳��Ă���ꍇ�́A�A���h�����j
        'create'              => ['get'],
        'edit'                => ['get'],
        'show'                => ['get'],
        'store'               => ['post'],
        'update'              => ['post'],
        'save'                => ['post'],
        'temporarysave'       => ['post'],
        'delete'              => ['post'],
        'destroy'             => ['post'],
        'approval'            => ['post'],

        // �Q�X�g�ł����s����郁�\�b�h
        'index'               => ['post'],
        'publicConfirm'       => ['post'],
        'publicStore'         => ['post'],

        // �o�P�c���t���[��
        'listBuckets'         => ['get'],
        'createBuckets'       => ['get'],
        'editBuckets'         => ['get'],
        'saveBuckets'         => ['post'],
        'destroyBuckets'      => ['post'],
        'changeBuckets'       => ['post'],

        'addColumn'           => ['post'],
        'editColumn'          => ['get'],
        'deleteColumn'        => ['post'],
        'reloadColumn'        => ['post'],
        'upColumnSequence'    => ['post'],
        'downColumnSequence'  => ['post'],
        'saveColumn'          => ['post'],
        'downloadCsv'         => ['post'],
    ],

];

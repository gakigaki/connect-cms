
// migration �̎w����@
// --path �ŃI�v�V������migration �t�@�C���̃p�X���w�肵�܂��B

// �e�[�u�������p
php artisan make:migration optionsamples_table --path=database/migrations_option --create=optionsamples

// �e�[�u���C���p
php artisan make:migration add_xxxxxx_id_to_xxxxxx_table --path=database/migrations_option --table=optionsamples

// ���s�p
php artisan migrate --path=database/migrations_option


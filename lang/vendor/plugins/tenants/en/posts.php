<?php

return [
    'create' => 'Create a new post',
    'form' => [
        'name' => 'Name',
        'name_placeholder' => 'Post\'s name (Maximum :c characters)',
        'description' => 'Description',
        'description_placeholder' => 'Short description for post (Maximum :c characters)',
        'categories' => 'Categories',
        'tags' => 'Tags',
        'tags_placeholder' => 'Tags',
        'content' => 'Content',
        'is_featured' => 'Feature this post',
        'note' => 'Note content',
        'format_type' => 'Format',
    ],
    'cannot_delete' => 'Post could not be deleted',
    'post_deleted' => 'Post deleted',
    'tenants' => 'Tenants',
    'post' => 'Post',
    'edit_this_post' => 'Edit this post',
    'no_new_post_now' => 'There is no new post now!',
    'menu_name' => 'Tenants',
    'widget_tenants_recent' => 'Recent Tenants',
    'categories' => 'Categories',
    'category' => 'Category',
    'author' => 'Author',
    'export' => [
        'description' => 'Export tenants to CSV/Excel file.',
        'total' => 'Total Tenants',
    ],
    'import' => [
        'description' => 'Import tenants from a CSV/Excel file.',
        'done_message' => ':created tenants created and :updated tenants updated.',
        'rules' => [
            'nullable_string_max' => 'The :attribute field accepts a string value of up to :max characters or may be left blank.',
            'sometimes_array' => 'The :attribute field accepts an array value or may be left blank.',
            'in' => ':attribute must be one of the following values: :values.',
            'nullable_string' => 'The :attribute field accepts a string value or may be left blank.',
            'nullable_string_max_in' => 'The :attribute field can be left blank, or must be a string with a maximum length of :max characters if provided and must be one of the following values: :values.',
        ],
    ],
];

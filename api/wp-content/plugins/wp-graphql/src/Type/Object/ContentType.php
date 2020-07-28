<?php

namespace WPGraphQL\Type\Object;

class ContentType {
	public static function register_type() {

		register_graphql_object_type(
			'ContentType',
			[
				'description' => __( 'An Post Type object', 'wp-graphql' ),
				'interfaces'  => [ 'Node' ],
				'fields'      => [
					'id'                  => [
						'description' => __( 'The globally unique identifier of the post-type object.', 'wp-graphql' ),
					],
					'name'                => [
						'type'        => 'String',
						'description' => __( 'The internal name of the post type. This should not be used for display purposes.', 'wp-graphql' ),
					],
					'label'               => [
						'type'        => 'String',
						'description' => __( 'Display name of the content type.', 'wp-graphql' ),
					],
					'labels'              => [
						'type'        => 'PostTypeLabelDetails',
						'description' => __( 'Details about the content type labels.', 'wp-graphql' ),
					],
					'description'         => [
						'type'        => 'String',
						'description' => __( 'Description of the content type.', 'wp-graphql' ),
					],
					'public'              => [
						'type'        => 'Boolean',
						'description' => __( 'Whether a content type is intended for use publicly either via the admin interface or by front-end users. While the default settings of exclude_from_search, publicly_queryable, show_ui, and show_in_nav_menus are inherited from public, each does not rely on this relationship and controls a very specific intention.', 'wp-graphql' ),
					],
					'hierarchical'        => [
						'type'        => 'Boolean',
						'description' => __( 'Whether the content type is hierarchical, for example pages.', 'wp-graphql' ),
					],
					'excludeFromSearch'   => [
						'type'        => 'Boolean',
						'description' => __( 'Whether to exclude nodes of this content type from front end search results.', 'wp-graphql' ),
					],
					'publiclyQueryable'   => [
						'type'        => 'Boolean',
						'description' => __( 'Whether queries can be performed on the front end for the content type as part of parse_request().', 'wp-graphql' ),
					],
					'showUi'              => [
						'type'        => 'Boolean',
						'description' => __( 'Whether to generate and allow a UI for managing this content type in the admin.', 'wp-graphql' ),
					],
					'showInMenu'          => [
						'type'        => 'Boolean',
						'description' => __( 'Where to show the content type in the admin menu. To work, $show_ui must be true. If true, the post type is shown in its own top level menu. If false, no menu is shown. If a string of an existing top level menu (eg. "tools.php" or "edit.php?post_type=page"), the post type will be placed as a sub-menu of that.', 'wp-graphql' ),
					],
					'showInNavMenus'      => [
						'type'        => 'Boolean',
						'description' => __( 'Makes this content type available for selection in navigation menus.', 'wp-graphql' ),
					],
					'showInAdminBar'      => [
						'type'        => 'Boolean',
						'description' => __( 'Makes this content type available via the admin bar.', 'wp-graphql' ),
					],
					'menuPosition'        => [
						'type'        => 'Int',
						'description' => __( 'The position of this post type in the menu. Only applies if show_in_menu is true.', 'wp-graphql' ),
					],
					'menuIcon'            => [
						'type'        => 'String',
						'description' => __( 'The name of the icon file to display as a menu icon.', 'wp-graphql' ),
					],
					'hasArchive'          => [
						'type'        => 'Boolean',
						'description' => __( 'Whether this content type should have archives. Content archives are generated by type and by date.', 'wp-graphql' ),
					],
					'canExport'           => [
						'type'        => 'Boolean',
						'description' => __( 'Whether this content type should can be exported.', 'wp-graphql' ),
					],
					'deleteWithUser'      => [
						'type'        => 'Boolean',
						'description' => __( 'Whether content of this type should be deleted when the author of it is deleted from the system.', 'wp-graphql' ),
					],
					'showInRest'          => [
						'type'        => 'Boolean',
						'description' => __( 'Whether the content type is associated with a route under the the REST API "wp/v2" namespace.', 'wp-graphql' ),
					],
					'restBase'            => [
						'type'        => 'String',
						'description' => __( 'Name of content type to display in REST API "wp/v2" namespace.', 'wp-graphql' ),
					],
					'restControllerClass' => [
						'type'        => 'String',
						'description' => __( 'The REST Controller class assigned to handling this content type.', 'wp-graphql' ),
					],
					'showInGraphql'       => [
						'type'        => 'Boolean',
						'description' => __( 'Whether to add the content type to the GraphQL Schema.', 'wp-graphql' ),
					],
					'graphqlSingleName'   => [
						'type'        => 'String',
						'description' => __( 'The singular name of the content type within the GraphQL Schema.', 'wp-graphql' ),
					],
					'graphqlPluralName'   => [
						'type'        => 'String',
						'description' => __( 'The plural name of the content type within the GraphQL Schema.', 'wp-graphql' ),
					],
					'isRestricted'        => [
						'type'        => 'Boolean',
						'description' => __( 'Whether the object is restricted from the current viewer', 'wp-graphql' ),
					],
				],

			]
		);

	}
}

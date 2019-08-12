<?php
//possible issues:
/*
  Spacing issues
  new query changes incorrect
  Queries->$ incorrect syntax
  Custom queries should work with ids across the board
*/

class Queries
{
  static $category_queries = [
    'artists' => 'SELECT
      SQL_CALC_FOUND_ROWS
      CONCAT(a.artist_fname,\' \', a.artist_lname) AS title,
      i.original AS src,
      a.id AS id,
      a.artist_lname AS lname
      FROM artists a
      JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname))
      WHERE i.featured = \'1\'
      GROUP BY a.id ORDER BY LTRIM(a.artist_lname) ASC, LTRIM(a.artist_fname) ASC',

    'institutions' => 'SELECT
      SQL_CALC_FOUND_ROWS name AS title,
      image_path AS src,
      CONCAT(address1,\' \',city,\' \',state) AS info,
      id
      FROM organizations
      ORDER BY organizations.name ASC LIMIT ? OFFSET ?;',

    'glazings' => 'SELECT
      SQL_CALC_FOUND_ROWS
      COUNT(i.id) AS count,
      g.glazing AS title,
      m.glazing_id AS id,
      i.original AS src
      FROM glazing g
      JOIN glazing_match m ON g.id = m.glazing_id
      JOIN images i ON m.image_id = i.id AND i.active = \'yes\'
      GROUP BY g.glazing ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

    'materials' => 'SELECT
      SQL_CALC_FOUND_ROWS
      COUNT(i.id) AS count,
      m.material AS title,
      mm.material_id AS id,
      i.original AS src
      FROM material m
      JOIN material_match mm ON m.id = mm.material_id
      JOIN images i ON mm.image_id = i.id AND i.active =\'yes\'
      GROUP BY m.material ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

    'objects' => 'SELECT
      SQL_CALC_FOUND_ROWS
      COUNT(i.id) AS count,
      o.object_type AS title,
      om.object_type_id AS id,
      i.original AS src
      FROM object_type o
      JOIN object_type_match om ON o.id = om.object_type_id
      JOIN images i ON om.image_id = i.id AND i.active = \'yes\'
      GROUP BY o.object_type ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

    'techniques' => 'SELECT
      SQL_CALC_FOUND_ROWS
      COUNT(i.id) AS count,
      t.technique AS title,
      tm.technique_id AS id,
      i.original AS src
      FROM techniques t
      JOIN technique_match tm ON t.id = tm.technique_id
      JOIN images i ON tm.image_id = i.id AND i.active = \'yes\'
      GROUP BY t.technique ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

    'temperatures' => 'SELECT
      SQL_CALC_FOUND_ROWS
      COUNT(i.id) AS count,
      te.temperature AS title,
      tem.temperature_id AS id,
      i.original AS src
      FROM temperature te
      JOIN temperature_match tem ON te.id = tem.temperature_id
      JOIN images i ON tem.image_id = i.id AND i.active = \'yes\'
      GROUP BY te.temperature ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;'
    ];


    static $custom_query_strings = [//
  		'base' =>  'SELECT
        SQL_CALC_FOUND_ROWS i.original AS src,
        i.title AS title,
        i.id AS id
        FROM images i',

      'end' => ' i.active = \'yes\' GROUP BY i.original ORDER BY i.artist_image_order LIMIT :lim OFFSET :ofs',

  		'glazing' => '
        JOIN glazing_match gm ON gm.image_id = i.id
        AND gm.glazing_id = (:glaze)',

  		'material' => '
        JOIN material_match mm ON mm.image_id = i.id
        AND mm.material_id = (:mat)',

  		'object' => '
        JOIN object_type_match om ON om.image_id = i.id
        AND om.object_type_id = (:obj)',

  		'technique' => '
        JOIN technique_match tm ON tm.image_id = i.id
        AND tm.technique_id = (:tech)',

  		'temperature' => '
        JOIN temperature_match tem ON tem.image_id = i.id
        AND tem.temperature_id = (:temp)',

  		'artist' => '
        WHERE i.artist_fname LIKE (:first)
        AND i.artist_lname LIKE (:last)',

  		'artist_id' => '
        JOIN artist_match am ON am.image_id = i.id
        AND am.artist_id = :id',

  		'added' =>' i.timestamp BETWEEN :time_s and :time_e',

  		'created' =>' i.date1 BETWEEN :year_s and :year_e',
  	];

    static $custom_order = [
  		'added' => 'ORDER BY i.timestamp DESC',

  		'artist' => 'ORDER BY i.artist_image_order'
  	];

    static $elaborate_queries = [
  		'image' =>'SELECT
        i.original AS src,
  			i.id,
  			i.title AS title,
  			CONCAT(i.artist_fname,\' \',i.artist_lname) AS artist,
  			i.date1 AS date,
  			i.height AS h,
  			i.width AS w,
  			i.depth AS d,
  			i.license AS license
  			FROM images i
        WHERE i.active = \'yes\'
        AND i.id = ? ',

      'object' => 'SELECT
        o.object_type AS object,
        o.id AS object_id
        FROM object_type_match om
        JOIN object_type o ON o.id = om.object_type_id
        WHERE om.image_id = ?',

  		'techniques' => 'SELECT
        t.technique,
        t.id AS technique_id
        FROM technique_match tm
        JOIN techniques t ON tm.technique_id = t.id
        WHERE tm.image_id = ?',

      'temp' => 'SELECT
        tt.temperature,
        tt.id AS temperature_id
        FROM temperature_match ttm
        JOIN temperature tt ON tt.id = ttm.temperature_id
        WHERE ttm.image_id = ?',

  		'glazing'=>'SELECT
        glazing,
        g.id AS glazing_id
        FROM glazing_match gm
        JOIN glazing g ON gm.glazing_id = g.id
        WHERE gm.image_id = ?',

  		'material'=>'SELECT
        material,
        m.id as material_id
        FROM material_match mm
        JOIN material m ON mm.material_id = m.id
        WHERE mm.image_id = ?'
  	];

    static $category_overview =
    [
      'collection'=>'SELECT
        COUNT(i.original) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM images i WHERE i.active = \'yes\';',

      'artists'=>'SELECT
        COUNT(a.id) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM artists a;',

      'glazing'=>'SELECT
        COUNT(g.id) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM glazing g;',

      'material'=>'SELECT
        COUNT(m.id) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM material m;',

      'object'=>'SELECT
        COUNT(o.id) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM object_type o;',

      'technique'=>'SELECT
        COUNT(t.id) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM techniques t;',

      'temperature'=>'SELECT
        COUNT(t.id) AS ct,
        (SELECT
          i2.original
          FROM images i2
          WHERE i2.active = \'yes\'
          AND i2.featured = 1
          ORDER BY RAND() LIMIT 1) AS src
        FROM temperature t;'
    ];

    static $artist_query = 'SELECT * from artists a WHERE a.id = ?';

  }


?>

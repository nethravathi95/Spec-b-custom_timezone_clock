<ul{{attributes.addClass(['menu', 'menu-level-'~items|first.menu_level])}}>
    {% for key, item in items %}
    
      {% if key|first != '#' %}
        {% set menu_item_classes = [
          'menu-item',
          item.is_expanded ? 'menu-item--expanded',
          item.is_collapsed ? 'menu-item--collapsed',
          item.in_active_trail ? 'menu-item--active-trail',
        ] %}

        <li{{item.attributes.addClass(menu_item_classes)}}>
          {{ link(item.title, item.url) }}
          {% set rendered_content = item.content|without('')|render %}
          {% if rendered_content %}
            {{ rendered_content }}
          {% endif %}
        </li>
      {% endif %}
  {% endfor %}
  </ul>
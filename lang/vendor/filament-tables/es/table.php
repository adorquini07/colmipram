<?php

return [
    'column_toggle' => [
        'heading' => 'Columnas',
    ],
    'columns' => [
        'text' => [
            'actions' => [
                'collapse_list' => 'Mostrar :count menos',
                'expand_list' => 'Mostrar :count más',
            ],
            'more_list_items' => 'y :count más',
        ],
    ],
    'fields' => [
        'bulk_select_page' => [
            'label' => 'Seleccionar/deseleccionar todos los elementos para acciones masivas.',
        ],
        'bulk_select_record' => [
            'label' => 'Seleccionar/deseleccionar elemento :key para acciones masivas.',
        ],
        'bulk_select_group' => [
            'label' => 'Seleccionar/deseleccionar grupo :title para acciones masivas.',
        ],
        'search' => [
            'label' => 'Buscar',
            'placeholder' => 'Buscar',
            'indicator' => 'Buscar',
        ],
    ],
    'summary' => [
        'heading' => 'Resumen',
        'subheadings' => [
            'all' => 'Todos :label',
            'group' => 'Resumen de :group',
            'page' => 'Esta página',
        ],
        'summarizers' => [
            'average' => [
                'label' => 'Promedio',
            ],
            'count' => [
                'label' => 'Cantidad',
            ],
            'sum' => [
                'label' => 'Suma',
            ],
        ],
    ],
    'actions' => [
        'disable_reordering' => [
            'label' => 'Terminar de reordenar registros',
        ],
        'enable_reordering' => [
            'label' => 'Reordenar registros',
        ],
        'filter' => [
            'label' => 'Filtrar',
        ],
        'group' => [
            'label' => 'Agrupar',
        ],
        'open_bulk_actions' => [
            'label' => 'Acciones masivas',
        ],
        'toggle_columns' => [
            'label' => 'Alternar columnas',
        ],
    ],
    'empty' => [
        'heading' => 'No se encontraron registros',
        'description' => 'Crea un :model para comenzar.',
    ],
    'filters' => [
        'actions' => [
            'apply' => [
                'label' => 'Aplicar filtros',
            ],
            'remove' => [
                'label' => 'Quitar filtro',
            ],
            'remove_all' => [
                'label' => 'Quitar todos los filtros',
                'tooltip' => 'Quitar todos los filtros',
            ],
            'reset' => [
                'label' => 'Restablecer',
            ],
        ],
        'heading' => 'Filtros',
        'indicator' => 'Filtros activos',
        'multi_select' => [
            'placeholder' => 'Todos',
        ],
        'select' => [
            'placeholder' => 'Todos',
        ],
        'trashed' => [
            'label' => 'Registros eliminados',
            'only_trashed' => 'Solo registros eliminados',
            'with_trashed' => 'Con registros eliminados',
            'without_trashed' => 'Sin registros eliminados',
        ],
    ],
    'grouping' => [
        'fields' => [
            'group' => [
                'label' => 'Agrupar por',
                'placeholder' => 'Agrupar por',
            ],
            'direction' => [
                'label' => 'Dirección de agrupación',
                'options' => [
                    'asc' => 'Ascendente',
                    'desc' => 'Descendente',
                ],
            ],
        ],
    ],
    'reorder_indicator' => 'Arrastra y suelta los registros en el orden deseado.',
    'selection_indicator' => [
        'selected_count' => '1 registro seleccionado|:count registros seleccionados',
        'actions' => [
            'select_all' => [
                'label' => 'Seleccionar todos :count',
            ],
            'deselect_all' => [
                'label' => 'Deseleccionar todos',
            ],
        ],
    ],
    'sorting' => [
        'fields' => [
            'column' => [
                'label' => 'Ordenar por',
            ],
            'direction' => [
                'label' => 'Dirección de ordenación',
                'options' => [
                    'asc' => 'Ascendente',
                    'desc' => 'Descendente',
                ],
            ],
        ],
    ],
];


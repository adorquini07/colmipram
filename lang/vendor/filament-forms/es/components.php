<?php

return [
    'builder' => [
        'actions' => [
            'clone' => [
                'label' => 'Clonar',
            ],
            'add' => [
                'label' => 'Añadir a :label',
            ],
            'add_between' => [
                'label' => 'Insertar entre bloques',
            ],
            'delete' => [
                'label' => 'Eliminar',
            ],
            'reorder' => [
                'label' => 'Mover',
            ],
            'move_down' => [
                'label' => 'Mover abajo',
            ],
            'move_up' => [
                'label' => 'Mover arriba',
            ],
            'collapse' => [
                'label' => 'Contraer',
            ],
            'expand' => [
                'label' => 'Expandir',
            ],
            'collapse_all' => [
                'label' => 'Contraer todos',
            ],
            'expand_all' => [
                'label' => 'Expandir todos',
            ],
        ],
    ],
    'checkbox_list' => [
        'actions' => [
            'deselect_all' => [
                'label' => 'Deseleccionar todos',
            ],
            'select_all' => [
                'label' => 'Seleccionar todos',
            ],
        ],
    ],
    'file_upload' => [
        'editor' => [
            'actions' => [
                'cancel' => [
                    'label' => 'Cancelar',
                ],
                'drag_crop' => [
                    'label' => 'Modo de arrastre "recortar"',
                ],
                'drag_move' => [
                    'label' => 'Modo de arrastre "mover"',
                ],
                'flip_horizontal' => [
                    'label' => 'Voltear imagen horizontalmente',
                ],
                'flip_vertical' => [
                    'label' => 'Voltear imagen verticalmente',
                ],
                'move_down' => [
                    'label' => 'Mover imagen abajo',
                ],
                'move_left' => [
                    'label' => 'Mover imagen a la izquierda',
                ],
                'move_right' => [
                    'label' => 'Mover imagen a la derecha',
                ],
                'move_up' => [
                    'label' => 'Mover imagen arriba',
                ],
                'reset' => [
                    'label' => 'Restablecer',
                ],
                'rotate_left' => [
                    'label' => 'Rotar imagen a la izquierda',
                ],
                'rotate_right' => [
                    'label' => 'Rotar imagen a la derecha',
                ],
                'save' => [
                    'label' => 'Guardar',
                ],
                'zoom_100' => [
                    'label' => 'Zoom al 100%',
                ],
                'zoom_in' => [
                    'label' => 'Acercar',
                ],
                'zoom_out' => [
                    'label' => 'Alejar',
                ],
            ],
            'fields' => [
                'height' => [
                    'label' => 'Alto',
                    'unit' => 'px',
                ],
                'rotation' => [
                    'label' => 'Rotación',
                    'unit' => 'grados',
                ],
                'width' => [
                    'label' => 'Ancho',
                    'unit' => 'px',
                ],
                'x_position' => [
                    'label' => 'X',
                    'unit' => 'px',
                ],
                'y_position' => [
                    'label' => 'Y',
                    'unit' => 'px',
                ],
            ],
            'aspect_ratios' => [
                'label' => 'Relación de aspecto',
                'no_fixed' => [
                    'label' => 'Libre',
                ],
            ],
            'svg' => [
                'messages' => [
                    'confirmation' => 'No se recomienda editar archivos SVG ya que puede resultar en pérdida de calidad al escalar.\n ¿Estás seguro de que deseas continuar?',
                    'disabled' => 'La edición de archivos SVG está desactivada ya que puede resultar en pérdida de calidad al escalar.',
                ],
            ],
        ],
    ],
    'key_value' => [
        'actions' => [
            'add' => [
                'label' => 'Añadir fila',
            ],
            'delete' => [
                'label' => 'Eliminar fila',
            ],
            'reorder' => [
                'label' => 'Reordenar fila',
            ],
        ],
        'fields' => [
            'key' => [
                'label' => 'Clave',
            ],
            'value' => [
                'label' => 'Valor',
            ],
        ],
    ],
    'markdown_editor' => [
        'toolbar_buttons' => [
            'attach_files' => 'Adjuntar archivos',
            'blockquote' => 'Cita',
            'bold' => 'Negrita',
            'bullet_list' => 'Lista con viñetas',
            'code_block' => 'Bloque de código',
            'heading' => 'Encabezado',
            'italic' => 'Cursiva',
            'link' => 'Enlace',
            'ordered_list' => 'Lista numerada',
            'redo' => 'Rehacer',
            'strike' => 'Tachado',
            'table' => 'Tabla',
            'undo' => 'Deshacer',
        ],
    ],
    'repeater' => [
        'actions' => [
            'add' => [
                'label' => 'Añadir a :label',
            ],
            'add_between' => [
                'label' => 'Insertar',
            ],
            'delete' => [
                'label' => 'Eliminar',
            ],
            'clone' => [
                'label' => 'Clonar',
            ],
            'reorder' => [
                'label' => 'Mover',
            ],
            'move_down' => [
                'label' => 'Mover abajo',
            ],
            'move_up' => [
                'label' => 'Mover arriba',
            ],
            'collapse' => [
                'label' => 'Contraer',
            ],
            'expand' => [
                'label' => 'Expandir',
            ],
            'collapse_all' => [
                'label' => 'Contraer todos',
            ],
            'expand_all' => [
                'label' => 'Expandir todos',
            ],
        ],
    ],
    'rich_editor' => [
        'dialogs' => [
            'link' => [
                'actions' => [
                    'link' => 'Enlazar',
                    'unlink' => 'Quitar enlace',
                ],
                'label' => 'URL',
                'placeholder' => 'Introduce una URL',
            ],
        ],
        'toolbar_buttons' => [
            'attach_files' => 'Adjuntar archivos',
            'blockquote' => 'Cita',
            'bold' => 'Negrita',
            'bullet_list' => 'Lista con viñetas',
            'code_block' => 'Bloque de código',
            'h1' => 'Título',
            'h2' => 'Encabezado',
            'h3' => 'Subencabezado',
            'italic' => 'Cursiva',
            'link' => 'Enlace',
            'ordered_list' => 'Lista numerada',
            'redo' => 'Rehacer',
            'strike' => 'Tachado',
            'underline' => 'Subrayado',
            'undo' => 'Deshacer',
        ],
    ],
    'select' => [
        'actions' => [
            'create_option' => [
                'modal' => [
                    'heading' => 'Crear',
                    'actions' => [
                        'create' => [
                            'label' => 'Crear',
                        ],
                        'create_another' => [
                            'label' => 'Crear y crear otro',
                        ],
                    ],
                ],
            ],
            'edit_option' => [
                'modal' => [
                    'heading' => 'Editar',
                    'actions' => [
                        'save' => [
                            'label' => 'Guardar',
                        ],
                    ],
                ],
            ],
        ],
        'boolean' => [
            'true' => 'Sí',
            'false' => 'No',
        ],
        'loading_message' => 'Cargando...',
        'max_items_message' => 'Solo se pueden seleccionar :count.',
        'no_search_results_message' => 'No hay opciones que coincidan con tu búsqueda.',
        'placeholder' => 'Selecciona una opción',
        'searching_message' => 'Buscando...',
        'search_prompt' => 'Escribe para buscar...',
    ],
    'tags_input' => [
        'placeholder' => 'Nueva etiqueta',
    ],
    'wizard' => [
        'actions' => [
            'previous_step' => [
                'label' => 'Anterior',
            ],
            'next_step' => [
                'label' => 'Siguiente',
            ],
        ],
    ],
];


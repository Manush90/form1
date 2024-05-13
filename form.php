<?php
class FormCreator
{
    private $action;
    private $method;
    private $fields;

    public function __construct($action, $method = 'post')
    {
        $this->action = $action;
        $this->method = $method;
        $this->fields = array();
    }

    public function addField($name, $type, $label, $options = array())
    {
        $this->fields[] = array(
            'name' => $name,
            'type' => $type,
            'label' => $label,
            'options' => $options
        );
    }

    public function render()
    {
        $html = '<style>
        body {
            display: flex;
                        align-items: center;
                        background-color: #E3AB5B ;
        }
                    .form-container {
                        background-color: white;
                        width: 300px;
                        margin: 0 auto;
                        padding: 20px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    .form-container label {
                        
                        display: block;
                        margin-bottom: 10px;
                    }
                    .form-container input[type="text"],
                    .form-container input[type="password"],
                    .form-container input[type="email"] {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }
                    .form-container button {
                        width: 100%;
                        padding: 10px;
                        background-color: #007bff;
                        color: #fff;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                    }
                </style>';

        $html .= '<div class="form-container">';
        $html .= '<form action="' . $this->action . '" method="' . $this->method . '">';

        foreach ($this->fields as $field) {
            $html .= '<label for="' . $field['name'] . '">' . $field['label'] . '</label>';
            $html .= '<input type="' . $field['type'] . '" name="' . $field['name'] . '" id="' . $field['name'] . '"';

            if (isset($field['options']['value'])) {
                $html .= ' value="' . $field['options']['value'] . '"';
            }

            if (isset($field['options']['placeholder'])) {
                $html .= ' placeholder="' . $field['options']['placeholder'] . '"';
            }

            $html .= '>';
        }

        $html .= '<button type="submit">Submit</button>';
        $html .= '</form>';
        $html .= '</div>';

        return $html;
    }
}

$form = new FormCreator('process.php', 'post');
$form->addField('username', 'text', 'Username');
$form->addField('password', 'password', 'Password');
$form->addField('email', 'email', 'Email', ['placeholder' => 'Enter your email']);
echo $form->render();

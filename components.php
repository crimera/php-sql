<?php
function text_input(string $text, string $id, string $name, string $value = "", string $type = "text")
{
    $html = <<<HTML
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">$text</span>
            <input type="$type" id="$id" value="$value" name="$name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
    HTML;
    return $html;
}

function img(string $file)
{
    return <<<HTML
        <img src="images/$file" width="50"/>
    HTML;
}

function select(string $label, string $name, array $cols)
{
    global $conn;

    $html =
        "<div class=\"input-group input-group-sm mb-3\">" .
        "<span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">$label</span>" .
        "<select class=\"form-select\" id=\"$name\" name=\"$name\">";

    foreach ($cols as $key => $value) {
        $html .= "<option value=\"$value\">$key</option>";
    }

    $html .= "</select></div>";

    return $html;
}

function modal(string $title, string $content, string $id, string $neutralButtonLabel, string $negativeButtonLabel)
{
    $html = <<<HTML
    <div class="modal fade" id="$id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">$title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    $content
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">$negativeButtonLabel</button>
                        <button type="submit" name="$id" class="btn btn-primary">$neutralButtonLabel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    HTML;

    echo $html;
}

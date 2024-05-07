<?php
function text_input(string $text, string $id, string $name)
{
    $html = <<<HTML
        <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm">$text</span>
            <input type="text" id="$id" name="$name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        </div>
    HTML;
    return $html;
}

function select(string $id, string $name, array $rows) {
    global $conn;

    $html = "<select id=\"$id\" name=\"$name\">";
}

function modal(string $title, string $content)
{
    $html = <<<HTML
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">$title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    $content
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
HTML;

    echo $html;
}
?>
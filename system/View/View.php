<?php

namespace System\View;

use System\Http\Response;
use Exception;

class View
{
    protected string $viewsPath;
    protected array $sections = [];
    protected string $currentSection = '';

    public function __construct(string $viewsPath)
    {
        $this->viewsPath = rtrim($viewsPath, '/');
    }

    public function render(string $view, array $data = []): Response
    {
        $file = $this->viewsPath . '/' . $view . '.fame.php';
        if (!file_exists($file)) {
            throw new Exception("View '$view' not found at $file");
        }

        extract($data);

        // Compile directives before including
        $compiled = $this->compile(file_get_contents($file));

        ob_start();
        eval('?>' . $compiled);
        $content = ob_get_clean();

        return (new Response())->setContent($content);
    }

    protected function compile(string $content): string
    {
        // Escaped variables: {{ $var }}
        $content = preg_replace_callback('/\{\{\s*(.+?)\s*\}\}/', function ($matches) {
            $expr = trim($matches[1]);

            // Allow certain helper functions to be output raw (like url(), asset(), route())
            if (preg_match('/^(url|asset|route)\(.*\)$/', $expr)) {
                return '<?= ' . $expr . ' ?>';
            }

            // Otherwise, escape output
            return '<?= htmlspecialchars(' . $expr . ') ?>';
        }, $content);

        // Raw output: {!! $var !!}
        $content = preg_replace('/\{!!\s*(.+?)\s*!!\}/', '<?= $1 ?>', $content);

        // @yield('section')
        $content = preg_replace_callback('/@yield\(\'([a-zA-Z0-9_]+)\'\)/', function ($matches) {
            $section = $matches[1];
            return '<?= $this->sections[\'' . $section . '\'] ?? "" ?>';
        }, $content);

        // @section('name') ... @endsection
        $content = preg_replace_callback('/@section\(\'([a-zA-Z0-9_]+)\'\)(.*?)@endsection/s', function ($matches) {
            $name = $matches[1];
            $body = $matches[2];
            return '<?php $this->sections[\'' . $name . '\'] = \'' . addslashes($body) . '\'; ?>';
        }, $content);

        // @include('view')
        $content = preg_replace_callback('/@include\(\'([a-zA-Z0-9_\/]+)\'\)/', function ($matches) {
            $file = $this->viewsPath . '/' . $matches[1] . '.fame.php';
            if (!file_exists($file)) return '';
            return '?>' . file_get_contents($file) . '<?php';
        }, $content);

        // @if / @elseif / @else / @endif
        $content = str_replace(['@if', '@elseif', '@else', '@endif'], ['<?php if', '<?php elseif', '<?php else:', '<?php endif; ?>'], $content);

        // @foreach / @endforeach
        $content = str_replace(['@foreach', '@endforeach'], ['<?php foreach', '<?php endforeach; ?>'], $content);

        // @csrf
        $content = preg_replace('/@csrf/', '<?= \System\Security\CSRF::tokenField() ?>', $content);

        // @method('PUT')
        $content = preg_replace('/@method\(\'(PUT|PATCH|DELETE)\'\)/', '<?= \System\Security\CSRF::methodField("$1") ?>', $content);

        return $content;
    }
}

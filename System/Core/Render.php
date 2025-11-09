<?php
namespace System\Core;

class Render
{
    protected function render(string $view, array $data = [])
    {
        $settings = require __DIR__ . '/../../App/Config/settings.php';
        $cacheEnabled = $settings['view_cache'] ?? false;
        $cacheDir = __DIR__ . '/../../App/Cache/Views/';
        $cacheFile = $cacheDir . md5($view) . '.php';
        
        if ($cacheEnabled) {
            if (file_exists($cacheFile) && !$settings['debug']) {
                extract($data);
                ob_start();
                require $cacheFile;
                return ob_get_clean();
            }
        }

        // --- View path ---
        $viewPath = __DIR__ . '/../../App/Views/' . $view . '.php';

        // --- Ha nincs ilyen view, fallback 404-re ---
        if (!file_exists($viewPath)) {
            ob_start();
            require __DIR__ . '/../../App/Views/404.php';
            $content = ob_get_clean();
            return $content;
        }

        // --- View tartalom összegyűjtése ---
        extract($data);
        ob_start();
        require $viewPath;
        $viewContent = ob_get_clean();

        // --- Subdir meghatározása (pl. user/dashboard -> user) ---
        $parts = explode('/', $view);
        $subdir = count($parts) > 1 ? $parts[0] : null;

        // --- Lehetséges template/layout fájlok ---
        $templateFiles = [];
        if ($subdir) {
            $templateFiles[] = __DIR__ . "/../../App/Views/$subdir/template.php";
            $templateFiles[] = __DIR__ . "/../../App/Views/$subdir/layout.php";
        }
        $templateFiles[] = __DIR__ . "/../../App/Views/template.php";
        $templateFiles[] = __DIR__ . "/../../App/Views/layout.php";

        // --- Megfelelő template/layout keresése ---
        $templatePath = null;
        foreach ($templateFiles as $tpl) {
            if (file_exists($tpl)) {
                $templatePath = $tpl;
                break;
            }
        }

        // --- Ha van template/layout, abba ágyazzuk a view-t ---
        if ($templatePath) {
            // $viewContent elérhető lesz a template-ben
            ob_start();
            // A layout/template-ben elérhető: $viewContent és az összes $data változó
            include $templatePath;
            $finalContent = ob_get_clean();
        } else {
            // Ha nincs template/layout, csak a view-t jelenítjük meg
            $finalContent = $viewContent;
        }

        // --- Cache mentés ---
        if ($cacheEnabled && isset($finalContent)) {
            if (!is_dir($cacheDir)) mkdir($cacheDir, 0777, true);
            file_put_contents($cacheFile, $finalContent);
        }

        return $finalContent;
    }
}
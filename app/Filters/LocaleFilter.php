<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LocaleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Получаем язык из сессии
        $locale = session('locale') ?? 'en';

        // Разрешённые языки
        $allowedLocales = ['ru', 'en', 'fi'];

        // Если язык не разрешён — используем русский
        if (!in_array($locale, $allowedLocales, true)) {
            $locale = 'en';
        }

        // Устанавливаем текущий язык
        service('language')->setLocale($locale);
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Ничего не делаем после запроса
    }
}
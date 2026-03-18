<?php
declare(strict_types=1);

function e(string|int|null $s): string
{
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

function redirect(string $url): void
{
    header("Location: $url");
    exit;
}

function is_post(): bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function flash_set(string $type, string $message): void
{
    $_SESSION['flash'][$type] = $message;
}

function flash_get(string $type): ?string
{
    if (!isset($_SESSION['flash'][$type])) {
        return null;
    }
    $msg = $_SESSION['flash'][$type];
    unset($_SESSION['flash'][$type]);
    return $msg;
}
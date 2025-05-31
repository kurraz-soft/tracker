#!/usr/bin/env python3
"""
Скрипт для поиска постеров фильмов/сериалов
Использует Google Custom Search API, при недоступности переключается на DuckDuckGo
"""

import sys
import requests
import argparse
from duckduckgo_search import DDGS
import os

# Конфигурация Google Custom Search
GOOGLE_API_KEY = os.getenv('GOOGLE_API_KEY')
GOOGLE_CSE_ID = os.getenv('GOOGLE_CSE_ID')

def search_google_poster(title):
    """Поиск постера через Google Custom Search API"""
    if not GOOGLE_API_KEY or not GOOGLE_CSE_ID:
        return None

    url = "https://www.googleapis.com/customsearch/v1"
    params = {
        'key': GOOGLE_API_KEY,
        'cx': GOOGLE_CSE_ID,
        'q': f'{title} poster movie cover',
        'searchType': 'image',
        'num': 3,
        'safe': 'off',
        'imgSize': 'medium'  # Фильтруем по размеру
    }

    try:
        response = requests.get(url, params=params, timeout=10)
        response.raise_for_status()

        data = response.json()
        if 'items' in data and len(data['items']) > 0:
            # Возвращаем URL первого изображения
            return data['items'][0]['link']

    except requests.exceptions.RequestException as e:
        print(f"Google API error: {e}", file=sys.stderr)
    except Exception as e:
        print(f"Google search error: {e}", file=sys.stderr)

    return None

def search_ddgs_poster(title):
    """Поиск постера через DuckDuckGo"""
    try:
        ddgs = DDGS()
        query = f"{title} poster movie cover"
        results = ddgs.images(query, max_results=3)

        if results:
            # Возвращаем URL первого изображения
            return results[0]['image']

    except Exception as e:
        print(f"DuckDuckGo search error: {e}", file=sys.stderr)

    return None

def search_poster(title):
    """Основная функция поиска с fallback логикой"""
    # Сначала пробуем Google
    poster_url = search_google_poster(title)
    if poster_url:
        print(f"Found via Google: {poster_url}", file=sys.stderr)
        return poster_url

    # Если Google не сработал, пробуем DuckDuckGo
    print("Google unavailable, trying DuckDuckGo...", file=sys.stderr)
    poster_url = search_ddgs_poster(title)
    if poster_url:
        print(f"Found via DuckDuckGo: {poster_url}", file=sys.stderr)
        return poster_url

    return None

def main():
    parser = argparse.ArgumentParser(description='Search for movie/TV show posters')
    parser.add_argument('title', help='Title of movie/TV show to search for')
    parser.add_argument('--verbose', '-v', action='store_true',
                       help='Enable verbose output to stderr')

    args = parser.parse_args()

    if not args.verbose:
        # Отключаем stderr сообщения если не в verbose режиме
        import logging
        logging.disable(logging.CRITICAL)

    poster_url = search_poster(args.title)

    if poster_url:
        print(poster_url)  # Выводим результат в stdout
        sys.exit(0)
    else:
        if args.verbose:
            print("No poster found", file=sys.stderr)
        sys.exit(1)

if __name__ == "__main__":
    main()
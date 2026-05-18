-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 13 2026 г., 14:11
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Stroimaster`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `excerpt`, `body`, `image`, `category`, `is_published`, `created_at`, `updated_at`) VALUES
(1, 'Как выбрать корм для кошки', 'kak-vybrat-korm-dlja-koshki', 'Полное руководство по выбору сухого и влажного корма для кошек всех пород и возрастов.', '<p>Выбор правильного корма для кошки ? одна из самых важных задач для заботливого хозяина. В этой статье мы расскажем, на что обращать внимание при выборе рациона для вашего питомца.</p><h3>1. Возраст кошки</h3><p>Котятам нужен корм с повышенным содержанием белка и кальция, взрослым кошкам ? сбалансированный рацион, а пожилым ? легкоусвояемая пища с поддержкой суставов.</p><h3>2. Тип корма</h3><p>Сухой корм удобен и помогает чистить зубы. Влажный корм содержит больше влаги и лучше подходит для кошек, склонных к мочекаменной болезни.</p><h3>3. Состав</h3><p>Ищите корма, где мясо указано первым ingredi?nt. Избегайте искусственных красителей и консервантов.</p><p>В нашем магазине представлены только качественные корма от проверенных производителей!</p>', '/public/img/cat-food-dry.webp', 'Корм', 1, NULL, NULL),
(2, 'Игрушки для собак: какие лучше?', 'igrushki-dlja-sobak-kakie-luchshe', 'Обзор лучших игрушек для собак разных пород и размеров.', '<p>Игрушки необходимы собакам для физического и психического развития. Правильно подобранная игрушка поможет направить энергию питомца в мирное русло и укрепить вашу связь.</p><h3>Для щенков</h3><p>Щенкам нужны мягкие игрушки для жевания, которые помогают при прорезывании зубов. Обратите внимание на резиновые кольца и канатики.</p><h3>Для активных пород</h3><p>Лабрадоры, овчарки и хаски обожают мячики, фрисби и игрушки для перетягивания. Важно, чтобы игрушки были прочными и безопасными.</p><h3>Для маленьких собак</h3><p>Йоркам, чихуахуа и той-терьерам подходят небольшие мягкие игрушки и пищалки.</p>', '/public/img/rubber-ball.webp', 'Игрушки', 1, NULL, NULL),
(3, 'Уход за шерстью кошек и собак', 'uhod-za-sherstju-koshek-i-sobak', 'Советы по грумингу: как правильно ухаживать за шерстью питомца.', '<p>Регулярный уход за шерстью ? залог здоровья и красоты вашего питомца. В этой статье мы собрали основные рекомендации по грумингу.</p><h3>Расчёсывание</h3><p>Длинношёрстных кошек и собак нужно расчёсывать ежедневно, короткошёрстных ? 1-2 раза в неделю. Используйте пуходёрку для подшёрстка и массажную щётку для массажа.</p><h3>Купание</h3><p>Не купайте питомца слишком часто ? достаточно раз в 1-3 месяца. Используйте только специальные шампуни для животных.</p><h3>Сезонная линька</h3><p>В период линьки используйте фурминатор ? он удаляет отмерший подшёрсток, не повреждая здоровую шерсть.</p>', '/public/img/cat-brush.webp', 'Средства ухода', 1, NULL, NULL),
(4, 'Как приучить котёнка к когтеточке', 'kak-priuchit-kotenka-k-kogteto?ke', 'Пошаговая инструкция по приучению котёнка к когтеточке.', '<p>Когтеточка ? необходимый аксессуар для каждой кошки. Она помогает сохранить мебель и даёт питомцу возможность точить когти естественным образом.</p><h3>Шаг 1: Выбор правильной когтеточки</h3><p>Котята предпочитают когтеточки из сизаля или картона. Высота должна быть такой, чтобы котёнок мог полностью вытянуться.</p><h3>Шаг 2: Размещение</h3><p>Поставьте когтеточку в любимом месте котёнка ? рядом с его лежанкой или у окна.</p><h3>Шаг 3: Привлечение внимания</h3><p>Используйте кошачью мяту или игрушки-дразнилки, чтобы показать котёнку, как пользоваться когтеточкой.</p><h3>Шаг 4: Поощрение</h3><p>Хвалите и угощайте котёнка каждый раз, когда он использует когтеточку.</p>', '/public/img/cat-scratcher.webp', 'Аксессуары', 1, NULL, NULL),
(5, 'Выбор клетки для попугая', 'vybor-kletki-dlja-popugaja', 'Как правильно выбрать клетку для волнистого попугая или крупного попугая.', '<p>Клетка ? дом для вашего попугая, поэтому к её выбору нужно подойти ответственно. Рассмотрим основные критерии.</p><h3>Размер</h3><p>Для волнистого попугая минимальный размер клетки ? 40?30?40 см. Для крупных пород нужна клетка не менее 60?50?70 см.</p><h3>Форма</h3><p>Лучше выбирать прямоугольные клетки ? в них попугаю проще ориентироваться. Круглые клетки дезориентируют птиц.</p><h3>Материал</h3><p>Металлические клетки с порошковым покрытием ? самый безопасный и долговечный вариант. Избегайте деревянных и медных элементов.</p>', '/public/img/parrot-cage.webp', 'Аксессуары', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Корм', 'Сухие и влажные корма для всех видов животных', '2026-05-08 10:00:00'),
(2, 'Игрушки', 'Игрушки для активных игр и развития питомцев', '2026-05-08 10:00:00'),
(3, 'Аксессуары', 'Миски, лежанки, поводки, ошейники и переноски', '2026-05-08 10:00:00'),
(4, 'Средства ухода', 'Шампуни, расчёски, когтерезки и гигиена', '2026-05-08 10:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_02_26_000001_add_role_to_users_table', 1),
(6, '2026_05_08_000001_add_animal_type_to_products_table', 1),
(8, '2026_05_08_000002_add_brand_age_sale_to_products_table', 2),
(9, '2026_05_08_000003_create_articles_table', 2),
(10, '2026_05_08_000004_create_promo_codes_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `status`, `total_amount`) VALUES
(12, 6, '2026-05-08 07:03:50', 'active', '1890.00'),
(13, 6, '2026-05-08 07:39:31', 'active', '450.00'),
(14, 6, '2026-05-08 07:43:32', 'active', '405.00'),
(15, 6, '2026-05-08 08:03:48', 'active', '81.00');

-- --------------------------------------------------------

--
-- Структура таблицы `order_cart`
--

CREATE TABLE `order_cart` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `products_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_cart`
--

INSERT INTO `order_cart` (`id`, `order_id`, `products_id`, `quantity`, `unit_price`) VALUES
(24, 12, 21, 1, '90.00'),
(25, 12, 20, 1, '1800.00'),
(26, 13, 1, 1, '450.00'),
(27, 14, 1, 1, '450.00'),
(28, 15, 21, 1, '90.00');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` int NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_stock` int NOT NULL DEFAULT '1',
  `animal_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `old_price`, `image`, `category`, `year`, `country`, `model`, `brand`, `in_stock`, `animal_type`, `age`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Корм сухой для кошек с курицей', 'Полнорационный сухой корм для взрослых кошек с нежным куриным вкусом. Содержит таурин и витамины.', '450.00', '520.00', '/public/img/cat-food-dry.webp', 'Корм', 2026, 'Россия', 'Purina Cat Chow', 'Purina', 50, 'Кошка', 'Взрослые', '2026-05-08 10:00:00', NULL, 1),
(2, 'Корм влажный для собак с говядиной', 'Влажный корм в паучах для взрослых собак всех пород. Натуральное мясо и овощи.', '120.00', NULL, '/public/img/dog-food-wet.webp', 'Корм', 2026, 'Германия', 'Pedigree Rodeo', 'Pedigree', 80, 'Собака', 'Взрослые', '2026-05-08 10:00:00', NULL, 1),
(3, 'Мяч резиновый для собак', 'Прочный резиновый мяч для активных игр с собакой. Диаметр 8 см.', '350.00', NULL, '/public/img/rubber-ball.webp', 'Игрушки', 2026, 'Китай', 'Kong Ball', 'Kong', 45, 'Собака', 'Все возраста', '2026-05-08 10:00:00', NULL, 2),
(4, 'Удочка-дразнилка для кошек с перьями', 'Интерактивная игрушка-удочка для кошек с яркими перьями на конце.', '250.00', NULL, '/public/img/cat-teaser.webp', 'Игрушки', 2026, 'Китай', 'Cat Toy 2000', 'Cat Toy', 60, 'Кошка', 'Взрослые', '2026-05-08 10:00:00', NULL, 2),
(5, 'Миска керамическая для кошек', 'Керамическая миска на нескользящей подставке. Объём 300 мл.', '400.00', '480.00', '/public/img/ceramic-bowl.webp', 'Аксессуары', 2026, 'Россия', 'Bowl Ceramic 300', 'Bowl Ceramic', 35, 'Кошка', 'Все возраста', '2026-05-08 10:00:00', NULL, 3),
(6, 'Ошейник светоотражающий для собак', 'Нейлоновый ошейник со светоотражающей полосой. Регулируемый.', '300.00', NULL, '/public/img/dog-collar.webp', 'Аксессуары', 2026, 'Россия', 'Reflective Collar M', 'Reflective', 40, 'Собака', 'Все возраста', '2026-05-08 10:00:00', NULL, 3),
(7, 'Шампунь для кошек и собак', 'Гипоаллергенный шампунь для всех пород. С ромашкой и алоэ вера.', '280.00', '350.00', '/public/img/pet-shampoo.webp', 'Средства ухода', 2026, 'Россия', 'CleanPet 500мл', 'CleanPet', 70, 'Все', 'Все возраста', '2026-05-08 10:00:00', NULL, 4),
(9, 'Корм сухой для попугаев', 'Зерновая смесь для средних и мелких попугаев. Обогащена витаминами.', '180.00', NULL, '/public/img/parrot-food.webp', 'Корм', 2026, 'Россия', 'Rio Parrot Mix', 'Rio', 40, 'Птица', 'Взрослые', '2026-05-08 10:00:00', NULL, 1),
(10, 'Клетка для попугая', 'Металлическая клетка с выдвижным поддоном. Размер 50x40x70 см.', '2500.00', '2900.00', '/public/img/parrot-cage.webp', 'Аксессуары', 2026, 'Польша', 'Cage Parrot 50', 'Cage Parrot', 15, 'Птица', 'Все возраста', '2026-05-08 10:00:00', NULL, 3),
(11, 'Корм для хомяков и морских свинок', 'Зерновая смесь для грызунов с добавлением сухофруктов.', '150.00', NULL, '/public/img/rodent-food.webp', 'Корм', 2026, 'Россия', 'RodentMix 500г', 'RodentMix', 55, 'Грызун', 'Взрослые', '2026-05-08 10:00:00', NULL, 1),
(12, 'Колесо беговое для грызунов', 'Пластиковое бесшумное колесо для хомяков и крыс. Диаметр 20 см.', '350.00', NULL, '/public/img/rodent-wheel.webp', 'Игрушки', 2026, 'Китай', 'Silent Wheel 20', 'Silent Wheel', 30, 'Грызун', 'Все возраста', '2026-05-08 10:00:00', NULL, 2),
(13, 'Корм для кошек с рыбой', 'Полнорационный сухой корм для кошек с лососем и тунцом.', '520.00', '590.00', '/public/img/cat-food-fish.webp', 'Корм', 2026, 'Франция', 'Whiskas Fish Feast', 'Whiskas', 60, 'Кошка', 'Взрослые', '2026-05-08 10:00:00', NULL, 1),
(14, 'Лежанка для собак', 'Мягкая лежанка с бортиками для собак мелких и средних пород.', '1200.00', '1500.00', '/public/img/dog-bed.webp', 'Аксессуары', 2026, 'Россия', 'Comfort Bed M', 'Comfort Bed', 20, 'Собака', 'Все возраста', '2026-05-08 10:00:00', NULL, 3),
(15, 'Расчёска-пуходёрка для кошек', 'Металлическая расчёска для удаления подшёрстка у кошек.', '200.00', NULL, '/public/img/cat-brush.webp', 'Средства ухода', 2026, 'Германия', 'FurMinator Mini', 'FurMinator', 35, 'Кошка', 'Взрослые', '2026-05-08 10:00:00', NULL, 4),
(16, 'Игрушка-канатик для собак', 'Плетёный канатик для перетягивания и игр с собакой. Прочный.', '180.00', NULL, '/public/img/dog-rope.webp', 'Игрушки', 2026, 'Китай', 'Tug Rope M', 'Tug Rope', 65, 'Собака', 'Все возраста', '2026-05-08 10:00:00', NULL, 2),
(17, 'Когтеточка для кошек', 'Напольная когтеточка с сизалем. Высота 60 см.', '650.00', '750.00', '/public/img/cat-scratcher.webp', 'Аксессуары', 2026, 'Россия', 'ScratchPost 60', 'ScratchPost', 25, 'Кошка', 'Все возраста', '2026-05-08 10:00:00', NULL, 3),
(18, 'Спрей от блох и клещей', 'Защитный спрей для кошек и собак от эктопаразитов. Флакон 200 мл.', '340.00', NULL, '/public/img/flea-spray.webp', 'Средства ухода', 2026, 'Россия', 'Bars Spray 200', 'Bars', 90, 'Все', 'Все возраста', '2026-05-08 10:00:00', NULL, 4),
(19, 'Корм сухой для щенков', 'Сухой корм для щенков мелких пород с курицей и рисом.', '380.00', '450.00', '/public/img/puppy-food.webp', 'Корм', 2026, 'Италия', 'Royal Canin Puppy', 'Royal Canin', 35, 'Собака', 'Щенки', '2026-05-08 10:00:00', NULL, 1),
(20, 'Переноска для кошек и собак', 'Пластиковая переноска с металлической дверцей. Подходит для авиаперелётов.', '1800.00', '2200.00', '/public/img/pet-carrier.webp', 'Аксессуары', 2026, 'Китай', 'Carrier M 50x35', 'Carrier', 18, 'Все', 'Все возраста', '2026-05-08 10:00:00', NULL, 3),
(21, 'Лакомство для кошек палочки', 'Мясные палочки для кошек с тунцом и сыром. Упаковка 50 г.', '90.00', NULL, '/public/img/cat-treats.webp', 'Корм', 2026, 'Россия', 'Yummy Stick', 'Yummy', 100, 'Кошка', 'Взрослые', '2026-05-08 10:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_type` enum('percent','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'percent',
  `discount_value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT NULL,
  `max_uses` int DEFAULT NULL,
  `used_count` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `expires_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount_type`, `discount_value`, `min_order_amount`, `max_uses`, `used_count`, `is_active`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME10', 'percent', '10.00', '500.00', 100, 0, 1, '2026-12-31', NULL, NULL),
(2, 'ZOOMAG20', 'percent', '20.00', '1500.00', 50, 0, 1, '2026-09-30', NULL, NULL),
(3, 'FREESHIP', 'fixed', '300.00', '2000.00', 200, 0, 1, '2026-08-31', NULL, NULL),
(4, 'PET500', 'fixed', '500.00', '3000.00', 30, 0, 1, '2026-07-31', NULL, NULL),
(5, 'SALE', 'percent', '10.00', NULL, NULL, 2, 1, '2026-05-10', '2026-05-08 07:39:14', '2026-05-08 07:39:14');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` tinyint NOT NULL DEFAULT '5',
  `review_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `phone`, `updated_at`, `created_at`) VALUES
(6, 'Admin', 'admin@zoomagazin.ru', 'admin', '$2y$10$wHoLzQ2fKkwRyMYjiAKzz.IQynjEAswTrJFi9rNaRLIa9wUoInOH2', '57L41U2j48bLT10GPcFsljcz1xbbvrAlhXzYrao1VlvONOCshieacKhuuHiN', '12312312312', '2026-05-13 11:09:53', '2026-05-08 09:00:00'),
(7, 'Покупатель', 'user@zoomagazin.ru', 'user', '$2y$10$bPc.gQ.DyVeywRkrEf4KdutnAwcL.znefibe1O4BBLU/YLldbHluu', NULL, '12345123451', '2026-05-08 10:00:00', '2026-05-08 09:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_slug_unique` (`slug`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_feedback_user` (`user_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order_cart`
--
ALTER TABLE `order_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `products_id` (`products_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_codes_code_unique` (`code`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `order_cart`
--
ALTER TABLE `order_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

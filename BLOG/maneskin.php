<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WS03</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --navy: #020817;
            --deep: #050e24;
            --blue-mid: #0a1f5c;
            --electric: #1e5bff;
            --neon: #3d9eff;
            --cyan: #00d4ff;
            --white: #f0f6ff;
            --muted: #8fa8c8;
            --card-bg: rgba(10, 25, 65, 0.6);
            --card-border: rgba(61, 158, 255, 0.18);
            --glow: rgba(61, 158, 255, 0.35);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--navy);
            color: var(--white);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .bg-canvas svg {
            width: 100%;
            height: 100%;
        }

        .page-wrap {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 2rem 6rem;
        }

        .artist-header {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 3rem;
            align-items: center;
            margin-bottom: 3.5rem;
            animation: fadeUp 0.8s ease both;
        }

        .artist-photo-wrap {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 3/4;
            box-shadow: 0 0 40px rgba(30, 91, 255, 0.3), 0 0 80px rgba(30, 91, 255, 0.1);
            border: 1px solid rgba(61, 158, 255, 0.3);
            flex-shrink: 0;
        }

        .artist-photo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            filter: saturate(0.85) contrast(1.05);
        }

        .artist-photo-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, transparent 50%, rgba(2, 8, 23, 0.7) 100%),
                linear-gradient(90deg, rgba(30, 91, 255, 0.08) 0%, transparent 100%);
            pointer-events: none;
        }

        .artist-text {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .badge {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--cyan);
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.25);
            padding: 4px 14px;
            border-radius: 2px;
            display: inline-block;
            margin-bottom: 0.75rem;
        }

        .artist-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(4rem, 10vw, 7.5rem);
            line-height: 0.92;
            letter-spacing: 0.02em;
            color: var(--white);
            animation: fadeUp 0.8s ease both, glow-pulse 4s 1.5s ease-in-out infinite;
        }

        .artist-name span {
            color: var(--neon);
            text-shadow: 0 0 40px rgba(61, 158, 255, 0.8);
        }

        .artist-desc {
            max-width: 560px;
            font-size: 15px;
            font-weight: 300;
            line-height: 1.75;
            color: var(--muted);
            margin-top: 1.2rem;
            border-left: 2px solid var(--electric);
            padding-left: 1.2rem;
        }

        .artist-meta {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-pill {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.08em;
            color: var(--neon);
            background: rgba(30, 91, 255, 0.12);
            border: 1px solid rgba(30, 91, 255, 0.3);
            padding: 5px 14px;
            border-radius: 30px;
        }

        .section-header {
            display: flex;
            align-items: baseline;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            animation: fadeUp 0.8s 0.15s ease both;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 2.8rem;
            letter-spacing: 0.04em;
            color: var(--white);
        }

        .section-subtitle {
            font-size: 13px;
            color: var(--muted);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 500;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, var(--electric) 0%, rgba(30, 91, 255, 0.1) 60%, transparent 100%);
            margin-bottom: 1rem;
            animation: fadeUp 0.8s 0.2s ease both;
        }

        .tracklist {
            display: flex;
            flex-direction: column;
            gap: 4px;
            animation: fadeUp 0.9s 0.25s ease both;
        }

        .track {
            display: grid;
            grid-template-columns: 40px 1fr auto;
            align-items: center;
            gap: 1rem;
            padding: 14px 20px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.28s cubic-bezier(0.22, 0.61, 0.36, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(8px);
        }

        .track::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(30, 91, 255, 0.08) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.28s ease;
        }

        .track:hover {
            background: rgba(15, 35, 90, 0.85);
            border-color: rgba(61, 158, 255, 0.55);
            transform: translateX(6px) scale(1.01);
            box-shadow: 0 0 24px rgba(30, 91, 255, 0.22), inset 0 0 30px rgba(61, 158, 255, 0.05);
        }

        .track:hover::before {
            opacity: 1;
        }

        .track-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            color: var(--blue-mid);
            text-align: center;
            transition: color 0.25s;
            position: relative;
            z-index: 1;
        }

        .track-play {
            display: none;
            color: var(--cyan);
            font-size: 1rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .track:hover .track-num {
            display: none;
        }

        .track:hover .track-play {
            display: block;
        }

        .track-info {
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        .track-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--white);
            letter-spacing: 0.02em;
            transition: color 0.25s;
        }

        .track:hover .track-title {
            color: var(--cyan);
        }

        .track-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
            position: relative;
            z-index: 1;
        }

        .track-duration {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted);
            font-variant-numeric: tabular-nums;
            letter-spacing: 0.04em;
            transition: color 0.25s;
        }

        .track:hover .track-duration {
            color: var(--white);
        }

        .track-mood {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 2px;
            opacity: 0;
            transition: opacity 0.28s ease;
        }

        .track:hover .track-mood {
            opacity: 1;
        }

        .mood-fire {
            color: #ff6b35;
            background: rgba(255, 107, 53, 0.12);
            border: 1px solid rgba(255, 107, 53, 0.25);
        }

        .mood-dark {
            color: #b794f4;
            background: rgba(183, 148, 244, 0.12);
            border: 1px solid rgba(183, 148, 244, 0.25);
        }

        .mood-raw {
            color: var(--cyan);
            background: rgba(0, 212, 255, 0.1);
            border: 1px solid rgba(0, 212, 255, 0.22);
        }

        .mood-rush {
            color: #ffd166;
            background: rgba(255, 209, 102, 0.1);
            border: 1px solid rgba(255, 209, 102, 0.22);
        }

        .mood-hype {
            color: #f72585;
            background: rgba(247, 37, 133, 0.12);
            border: 1px solid rgba(247, 37, 133, 0.25);
        }

        .footer {
            margin-top: 3.5rem;
            text-align: center;
            color: rgba(143, 168, 200, 0.4);
            font-size: 12px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            animation: fadeUp 0.8s 0.4s ease both;
        }

        .footer strong {
            color: rgba(61, 158, 255, 0.5);
            font-weight: 500;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes glow-pulse {

            0%,
            100% {
                text-shadow: 0 0 60px rgba(61, 158, 255, 0.4), 0 0 120px rgba(30, 91, 255, 0.2);
            }

            50% {
                text-shadow: 0 0 100px rgba(61, 158, 255, 0.7), 0 0 200px rgba(30, 91, 255, 0.4);
            }
        }
    </style>
</head>

<body>

    <!-- Background -->
    <div class="bg-canvas">
        <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <radialGradient id="g1" cx="15%" cy="30%" r="50%">
                    <stop offset="0%" stop-color="#0a2080" stop-opacity="0.6" />
                    <stop offset="100%" stop-color="#020817" stop-opacity="0" />
                </radialGradient>
                <radialGradient id="g2" cx="80%" cy="70%" r="45%">
                    <stop offset="0%" stop-color="#002a6e" stop-opacity="0.5" />
                    <stop offset="100%" stop-color="#020817" stop-opacity="0" />
                </radialGradient>
                <radialGradient id="g3" cx="50%" cy="10%" r="40%">
                    <stop offset="0%" stop-color="#001a5c" stop-opacity="0.4" />
                    <stop offset="100%" stop-color="#020817" stop-opacity="0" />
                </radialGradient>
            </defs>
            <rect width="1440" height="900" fill="#020817" />
            <rect width="1440" height="900" fill="url(#g1)" />
            <rect width="1440" height="900" fill="url(#g2)" />
            <rect width="1440" height="900" fill="url(#g3)" />
            <g opacity="0.12" stroke="#3d9eff" stroke-width="1" fill="none">
                <path d="M-100,180 C200,120 400,240 700,160 S1100,200 1540,140" />
                <path d="M-100,220 C200,160 400,280 700,200 S1100,240 1540,180" />
                <path d="M-100,380 C300,300 500,460 800,360 S1200,400 1540,320" />
                <path d="M-100,420 C300,340 500,500 800,400 S1200,440 1540,360" />
                <path d="M-100,560 C250,480 500,600 850,520 S1250,560 1540,500" />
                <path d="M-100,600 C250,520 500,640 850,560 S1250,600 1540,540" />
                <path d="M-100,720 C350,640 600,760 950,680 S1300,720 1540,660" />
            </g>
            <g opacity="0.04" stroke="#3d9eff" stroke-width="0.5">
                <line x1="0" y1="0" x2="0" y2="900" />
                <line x1="180" y1="0" x2="180" y2="900" />
                <line x1="360" y1="0" x2="360" y2="900" />
                <line x1="540" y1="0" x2="540" y2="900" />
                <line x1="720" y1="0" x2="720" y2="900" />
                <line x1="900" y1="0" x2="900" y2="900" />
                <line x1="1080" y1="0" x2="1080" y2="900" />
                <line x1="1260" y1="0" x2="1260" y2="900" />
                <line x1="1440" y1="0" x2="1440" y2="900" />
            </g>
            <g opacity="0.25">
                <circle cx="80" cy="650" r="3" fill="#00d4ff" />
                <circle cx="100" cy="670" r="1.5" fill="#00d4ff" />
                <circle cx="65" cy="672" r="1" fill="#3d9eff" />
                <circle cx="1350" cy="200" r="3" fill="#1e5bff" />
                <circle cx="1370" cy="218" r="1.5" fill="#3d9eff" />
                <circle cx="1335" cy="220" r="1" fill="#00d4ff" />
            </g>
        </svg>
    </div>

    <div class="page-wrap">

        <!-- Artist Header -->
        <div class="artist-header">
            <div class="artist-photo-wrap">
                <img src="<?php echo htmlspecialchars('manskin.jpg'); ?>" alt="Måneskin" />
            </div>
            <div class="artist-text">
                <div class="badge">Italian Rock Band · Est. 2010 · Rome</div>
                <h1 class="artist-name">Måne<span>skin</span></h1>
                <p class="artist-desc">
                    Born from the streets of Rome, Måneskin erupted onto the global stage with an unapologetically raw energy —
                    leather-clad, gender-fluid, and ferociously loud. Equal parts glam-rock swagger and modern punk rebellion,
                    they've made rock dangerous again. Their sound: vintage riffs reborn in neon.
                </p>
                <div class="artist-meta">
                    <span class="meta-pill">Modern Rock Revival</span>
                    <span class="meta-pill">Glam · Punk · Hard Rock</span>
                    <span class="meta-pill">Eurovision Winners 2021</span>
                </div>
            </div>
        </div>

        <!-- Playlist -->
        <div class="section-header">
            <h2 class="section-title">Rush!</h2>
            <span class="section-subtitle">Are You Coming? · 2023</span>
        </div>
        <div class="divider"></div>

        <?php
        $tracks = [
            ["01", "HONEY (ARE U COMING?)",          "2:47", "mood-fire", "Anthem"],
            ["02", "VALENTINE",                      "3:36", "mood-dark", "Ballad"],
            ["03", "OFF MY FACE",                    "2:29", "mood-rush", "Bop"],
            ["04", "THE DRIVER",                     "3:08", "mood-raw", "Drive"],
            ["05", "TRASTEVERE",                     "3:02", "mood-raw", "Rome"],
            ["06", "OWN MY MIND",                    "3:11", "mood-fire", "Anthem"],
            ["07", "GOSSIP (FEAT. TOM MORELLO)",     "2:48", "mood-rush", "Noise"],
            ["08", "TIMEZONE",                       "2:59", "mood-dark", "Late Night"],
            ["09", "BLA BLA BLA",                   "3:04", "mood-hype", "Defiant"],
            ["10", "BABY SAID",                     "2:44", "mood-fire", "Swagger"],
            ["11", "GASOLINE",                      "3:41", "mood-hype", "Fuel"],
            ["12", "FEEL",                          "2:47", "mood-raw", "Yearning"],
            ["13", "DON'T WANNA SLEEP",             "2:36", "mood-dark", "Insomnia"],
            ["14", "KOOL KIDS",                     "2:43", "mood-rush", "Rebel"],
            ["15", "IF NOT FOR YOU",                "3:14", "mood-dark", "Longing"],
            ["16", "READ YOUR DIARY",               "2:30", "mood-raw", "Obsessive"],
            ["17", "MARK CHAPMAN",                  "3:40", "mood-dark", "Haunted"],
            ["18", "LA FINE",                       "3:20", "mood-dark", "Bruised"],
            ["19", "IL DONO DELLA VITA",            "3:44", "mood-raw", "Stripped"],
            ["20", "MAMMAMIA",                      "3:06", "mood-fire", "Anthem"],
            ["21", "SUPERMODEL",                    "2:28", "mood-hype", "Runway"],
            ["22", "THE LONELIEST",                 "4:07", "mood-dark", "Solitude"],
        ];
        ?>

        <div class="tracklist" role="list" aria-label="Rush! Are You Coming? tracklist">
            <?php foreach ($tracks as [$num, $title, $duration, $mood, $label]): ?>
                <div class="track" role="listitem" tabindex="0">
                    <span class="track-num"><?php echo $num; ?></span>
                    <span class="track-play">&#9654;</span>
                    <div class="track-info">
                        <span class="track-title"><?php echo htmlspecialchars($title); ?></span>
                    </div>
                    <div class="track-right">
                        <span class="track-duration"><?php echo $duration; ?></span>
                        <span class="track-mood <?php echo $mood; ?>"><?php echo $label; ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="footer">
            <p>Rush! (Are You Coming?) · Måneskin · <strong>Epic Records · 2023</strong></p>
            <p style="margin-top:6px;">22 Tracks · 67 min 44 sec · Italian Rock</p>
        </div>
</body>

</html>
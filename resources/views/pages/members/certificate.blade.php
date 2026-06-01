<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Certificate of Completion — {{ $user->name }} | GISBA</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,500&family=EB+Garamond:wght@400;500&family=Great+Vibes&display=swap" rel="stylesheet">
  <style>
    :root {
      --navy: #0a2342;
      --navy-deep: #061629;
      --ink: #20303f;
      --gold: #c8a84b;
      --gold-bright: #e8cf86;
      --gold-deep: #9a7d2e;
      --paper: #fbf7ee;
      --paper-edge: #f3ecdb;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'EB Garamond', Georgia, serif;
      color: var(--ink);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 36px 16px 56px;
      background:
        radial-gradient(1200px 700px at 50% -10%, #11315a 0%, transparent 60%),
        radial-gradient(900px 600px at 50% 120%, #0c2444 0%, transparent 55%),
        linear-gradient(160deg, #0c2444 0%, #061224 100%);
      background-color: #08182f;
    }

    /* ── Toolbar (screen only) ─────────────────────────────── */
    .toolbar {
      width: 100%;
      max-width: 1080px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      margin-bottom: 26px;
      flex-wrap: wrap;
    }
    .toolbar a {
      color: var(--gold-bright);
      text-decoration: none;
      font-family: 'Cinzel', serif;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      opacity: 0.85;
      transition: opacity 0.2s;
    }
    .toolbar a:hover { opacity: 1; }
    .btn-print {
      background: linear-gradient(180deg, var(--gold-bright), var(--gold) 55%, var(--gold-deep));
      color: var(--navy-deep);
      border: 1px solid rgba(255,255,255,0.35);
      border-radius: 4px;
      padding: 12px 26px;
      font-family: 'Cinzel', serif;
      font-weight: 700;
      font-size: 12.5px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 9px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.5);
      transition: transform 0.18s, box-shadow 0.18s;
    }
    .btn-print:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.6); }

    /* ── Certificate sheet ─────────────────────────────────── */
    .certificate {
      width: 1080px;
      max-width: 100%;
      aspect-ratio: 1.414 / 1;
      position: relative;
      padding: 12px;
      background:
        linear-gradient(135deg, var(--paper) 0%, var(--paper-edge) 100%);
      box-shadow:
        0 40px 90px rgba(0,0,0,0.55),
        0 0 0 1px rgba(0,0,0,0.06);
      animation: rise 0.9s cubic-bezier(.2,.8,.2,1) both;
    }
    @keyframes rise { from { opacity: 0; transform: translateY(26px) scale(.985); } to { opacity: 1; transform: none; } }

    /* paper grain + faint guilloché wash */
    .certificate::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        repeating-radial-gradient(circle at 50% 50%, rgba(10,35,66,0.025) 0 1px, transparent 1px 3px),
        repeating-linear-gradient(58deg, rgba(154,125,46,0.04) 0 1px, transparent 1px 9px),
        repeating-linear-gradient(-58deg, rgba(154,125,46,0.04) 0 1px, transparent 1px 9px);
      mix-blend-mode: multiply;
      pointer-events: none;
    }

    /* engraved double frame */
    .frame {
      position: relative;
      height: 100%;
      border: 2px solid var(--gold-deep);
      outline: 1px solid var(--gold);
      outline-offset: 5px;
      padding: 52px 64px 44px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      background:
        linear-gradient(180deg, rgba(10,35,66,0.015), transparent 18%);
    }
    .frame::after {
      content: '';
      position: absolute;
      inset: 11px;
      border: 1px solid rgba(154,125,46,0.5);
      pointer-events: none;
    }

    /* corner flourishes */
    .corner {
      position: absolute;
      width: 58px;
      height: 58px;
      z-index: 3;
      opacity: 0.92;
    }
    .corner svg { width: 100%; height: 100%; display: block; }
    .corner.tl { top: 6px; left: 6px; }
    .corner.tr { top: 6px; right: 6px; transform: scaleX(-1); }
    .corner.bl { bottom: 6px; left: 6px; transform: scaleY(-1); }
    .corner.br { bottom: 6px; right: 6px; transform: scale(-1,-1); }

    /* ── Header ─────────────────────────────────────────────── */
    .crest {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      margin-bottom: 16px;
      background:
        radial-gradient(circle at 50% 38%, #12365f, #0a2342 70%);
      box-shadow: 0 0 0 2px var(--gold), 0 0 0 4px var(--paper), 0 0 0 5px rgba(154,125,46,0.55);
      overflow: hidden;
    }
    .crest img { width: 76%; height: 76%; object-fit: contain; }

    .eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 12px;
      letter-spacing: 7px;
      text-transform: uppercase;
      color: var(--gold-deep);
      font-weight: 600;
      margin-bottom: 4px;
      padding-left: 7px;
    }
    .eyebrow-rule {
      display: flex; align-items: center; justify-content: center; gap: 12px;
      margin-bottom: 18px; color: var(--gold-deep);
    }
    .eyebrow-rule::before, .eyebrow-rule::after {
      content: ''; height: 1px; width: 64px;
      background: linear-gradient(90deg, transparent, var(--gold-deep));
    }
    .eyebrow-rule::after { background: linear-gradient(90deg, var(--gold-deep), transparent); }
    .eyebrow-rule .diamond { width: 6px; height: 6px; background: var(--gold); transform: rotate(45deg); }

    .title {
      font-family: 'Cinzel', serif;
      font-size: 50px;
      font-weight: 800;
      line-height: 1.04;
      color: var(--navy);
      letter-spacing: 1px;
      margin-bottom: 8px;
    }
    .subtitle {
      font-family: 'Cinzel', serif;
      font-size: 14px;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--gold-deep);
      margin-bottom: 26px;
    }

    .presented {
      font-family: 'Cormorant Garamond', serif;
      font-style: italic;
      font-size: 17px;
      color: #5a6675;
      margin-bottom: 6px;
    }
    .name {
      font-family: 'Great Vibes', cursive;
      font-size: 70px;
      line-height: 0.9;
      color: var(--navy);
      margin: 2px 0 6px;
      text-shadow: 0 1px 0 rgba(255,255,255,0.6);
    }
    .name-rule {
      width: 420px; max-width: 72%; height: 0; margin: 0 auto 22px;
      border: none;
      border-top: 1px solid var(--gold-deep);
      position: relative;
    }
    .name-rule::after {
      content: '❧'; position: absolute; left: 50%; top: 50%;
      transform: translate(-50%,-50%); background: var(--paper);
      padding: 0 12px; color: var(--gold-deep); font-size: 15px;
    }

    .body {
      font-family: 'Cormorant Garamond', serif;
      font-size: 18.5px;
      line-height: 1.65;
      color: #3c4a59;
      max-width: 640px;
      margin-bottom: 26px;
    }
    .course {
      font-weight: 600;
      color: var(--navy);
      font-style: italic;
    }

    /* ── Footer: signature / seal / number ─────────────────── */
    .footer {
      width: 100%;
      margin-top: auto;
      display: grid;
      grid-template-columns: 1fr auto 1fr;
      align-items: end;
      gap: 28px;
    }
    .pillar { text-align: center; }
    .pillar .mark {
      font-family: 'Great Vibes', cursive;
      font-size: 32px;
      color: var(--ink);
      line-height: 1.1;
      min-height: 40px;
      display: flex; align-items: flex-end; justify-content: center;
    }
    .pillar .plate {
      font-family: 'Cinzel', serif;
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 1px;
      color: var(--navy);
      min-height: 40px;
      display: flex; align-items: flex-end; justify-content: center;
    }
    .pillar .rule { height: 1px; background: var(--ink); opacity: 0.5; margin: 6px 0 7px; }
    .pillar .label {
      font-family: 'Cinzel', serif;
      font-size: 10px; letter-spacing: 2.5px; text-transform: uppercase;
      color: #7b8694;
    }

    /* gold medallion seal */
    .seal {
      width: 132px; height: 132px;
      position: relative;
      display: grid; place-items: center;
      margin-bottom: 2px;
      filter: drop-shadow(0 6px 10px rgba(0,0,0,0.28));
    }
    /* crisp sunburst ring */
    .seal .rays {
      position: absolute; inset: 0; border-radius: 50%;
      background: repeating-conic-gradient(from 0deg, var(--gold-deep) 0deg 2deg, transparent 2deg 7.5deg);
      -webkit-mask: radial-gradient(circle at 50% 50%, transparent 0 44px, #000 45px 64px, transparent 65px);
      mask: radial-gradient(circle at 50% 50%, transparent 0 44px, #000 45px 64px, transparent 65px);
      z-index: 1;
    }
    .seal .disc {
      width: 100px; height: 100px; border-radius: 50%;
      background:
        radial-gradient(circle at 38% 32%, var(--gold-bright), var(--gold) 46%, var(--gold-deep) 100%);
      box-shadow: inset 0 0 0 2px rgba(255,255,255,0.45), inset 0 0 0 5px var(--gold-deep), inset 0 0 16px rgba(0,0,0,0.28), 0 0 0 1px var(--gold-deep);
      display: grid; place-items: center;
      position: relative;
      z-index: 2;
    }
    .seal .disc::before {
      content: ''; position: absolute; inset: 11px; border-radius: 50%;
      border: 1px solid rgba(10,35,66,0.35);
    }
    .seal .disc .monogram {
      font-family: 'Cinzel', serif;
      font-weight: 800;
      font-size: 38px;
      color: var(--navy-deep);
      letter-spacing: 1px;
      text-shadow: 0 1px 0 rgba(255,255,255,0.4);
      position: relative; z-index: 2;
    }
    .seal .ribbon { position: absolute; bottom: -14px; width: 86px; height: 34px; z-index: 0; }
    .seal .ribbon span {
      position: absolute; top: 0; width: 26px; height: 34px;
      background: linear-gradient(180deg, var(--gold) 0%, var(--gold-deep) 100%);
      box-shadow: inset 0 0 4px rgba(0,0,0,0.25);
    }
    .seal .ribbon span.l { left: 8px; transform: skewX(8deg); clip-path: polygon(0 0,100% 0,100% 100%,50% 78%,0 100%); }
    .seal .ribbon span.r { right: 8px; transform: skewX(-8deg); clip-path: polygon(0 0,100% 0,100% 100%,50% 78%,0 100%); }

    .seal-caption {
      font-family: 'Cinzel', serif;
      font-size: 9px; letter-spacing: 2px; text-transform: uppercase;
      color: var(--gold-deep); margin-top: 18px;
    }
    .seal-wrap { display: flex; flex-direction: column; align-items: center; }

    .verify {
      margin-top: 22px;
      font-family: 'EB Garamond', serif;
      font-size: 11px;
      letter-spacing: 0.4px;
      color: #8b94a0;
    }
    .verify b { color: var(--gold-deep); font-weight: 600; letter-spacing: 1px; }

    /* ── Print ─────────────────────────────────────────────── */
    @page { size: A4 landscape; margin: 0; }
    @media print {
      html, body { background: #fff !important; padding: 0; }
      .toolbar { display: none !important; }
      .certificate {
        width: 100%;
        height: 100vh;
        max-width: none;
        aspect-ratio: auto;
        box-shadow: none;
        animation: none;
        padding: 6mm;
      }
      .frame { padding: 14mm 20mm 12mm; }
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    @media (prefers-reduced-motion: reduce) { .certificate { animation: none; } }

    @media (max-width: 700px) {
      .frame { padding: 32px 22px 28px; }
      .title { font-size: 32px; }
      .name { font-size: 48px; }
      .footer { grid-template-columns: 1fr; gap: 30px; }
    }
  </style>
</head>
<body>
  <div class="toolbar">
    <a href="{{ route('members.chapters.index') }}">&larr; Back to Training</a>
    <button type="button" class="btn-print" onclick="window.print()">
      &#9113; Print&nbsp;/&nbsp;Save&nbsp;PDF
    </button>
  </div>

  <div class="certificate">
    <div class="frame">

      {{-- corner flourishes --}}
      @php
        $flourish = '<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 4h40M4 4v40" stroke="#9a7d2e" stroke-width="2"/><path d="M12 12c22 0 34 0 34 34" stroke="#c8a84b" stroke-width="1.4"/><path d="M12 12c0 14 6 22 22 22" stroke="#9a7d2e" stroke-width="1.2"/><circle cx="12" cy="12" r="3" fill="#c8a84b"/><path d="M20 12c8 0 14 4 14 14" stroke="#c8a84b" stroke-width="1"/></svg>';
      @endphp
      <span class="corner tl">{!! $flourish !!}</span>
      <span class="corner tr">{!! $flourish !!}</span>
      <span class="corner bl">{!! $flourish !!}</span>
      <span class="corner br">{!! $flourish !!}</span>

      <div class="crest">
        <img src="{{ asset('assets/images/logo.jpg') }}" alt="GISBA">
      </div>

      <div class="eyebrow">Certificate of Completion</div>
      <div class="eyebrow-rule"><span class="diamond"></span></div>

      <h1 class="title">PMP Quick Review</h1>
      <div class="subtitle">Training Programme</div>

      <p class="presented">This certificate is proudly presented to</p>
      <div class="name">{{ $user->name }}</div>
      <hr class="name-rule">

      <p class="body">
        for the successful completion of the <span class="course">PMP Quick Review Training</span>
        programme offered by GISBA, having diligently reviewed every chapter and training
        resource in full.
      </p>

      <div class="footer">
        {{-- Date --}}
        <div class="pillar">
          <div class="plate">{{ $certificate->completed_at->format('F j, Y') }}</div>
          <div class="rule"></div>
          <div class="label">Date of Completion</div>
        </div>

        {{-- Seal --}}
        <div class="seal-wrap">
          <div class="seal">
            <div class="rays"></div>
            <div class="ribbon"><span class="l"></span><span class="r"></span></div>
            <div class="disc"><span class="monogram">G</span></div>
          </div>
          <div class="seal-caption">Global Institute &middot; GISBA</div>
        </div>

        {{-- Signature --}}
        <div class="pillar">
          {{-- Swap "GISBA" for the authorized signer's name or a signature image. --}}
          <div class="mark">GISBA</div>
          <div class="rule"></div>
          <div class="label">Director, GISBA</div>
        </div>
      </div>

      <div class="verify">
        Certificate No. <b>{{ $certificate->certificate_number }}</b>
      </div>

    </div>
  </div>
</body>
</html>

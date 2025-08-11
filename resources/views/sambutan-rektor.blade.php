@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;1,400&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        line-height: 1.6;
        overflow-x: hidden;
    }

    .crimson {
        font-family: 'Crimson Text', serif;
    }

    /* Magazine Header */
    .magazine-header {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .magazine-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="50" cy="10" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="10" cy="60" r="1" fill="%23ffffff" opacity="0.03"/><circle cx="90" cy="40" r="1" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }

    .magazine-title {
        position: absolute;
        top: 3rem;
        left: 3rem;
        color: #fff;
        font-size: 1.2rem;
        font-weight: 300;
        letter-spacing: 3px;
        text-transform: uppercase;
        z-index: 10;
    }

    .magazine-date {
        position: absolute;
        top: 3rem;
        right: 3rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        font-weight: 300;
        z-index: 10;
    }

    .split-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        height: 100vh;
        position: relative;
        z-index: 5;
    }

    .content-side {
        padding: 4rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
    }

    .image-side {
        position: relative;
        overflow: hidden;
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(20%) contrast(1.1);
        transition: all 0.8s ease;
    }

    .hero-image:hover {
        filter: grayscale(0%) contrast(1.2) brightness(1.1);
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(26, 26, 46, 0.3) 0%, rgba(15, 52, 96, 0.2) 100%);
        z-index: 2;
    }

    .hero-subtitle {
        color: #ffd700;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1rem;
        position: relative;
    }

    .hero-subtitle::after {
        content: '';
        position: absolute;
        bottom: -0.5rem;
        left: 0;
        width: 60px;
        height: 2px;
        background: #ffd700;
    }

    .hero-title {
        color: #fff;
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 2rem;
        letter-spacing: -2px;
    }

    .hero-description {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 3rem;
        max-width: 500px;
    }

    .rector-info-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 2rem;
        margin-top: 2rem;
    }

    .rector-name {
        color: #fff;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .rector-title {
        color: #ffd700;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .rector-degree {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
        font-weight: 400;
    }

    .rector-details {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .rector-detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .rector-detail-label {
        color: rgba(255, 255, 255, 0.7);
    }

    .rector-detail-value {
        color: #fff;
        font-weight: 500;
    }

    /* Article Section */
    .article-section {
        background: #fff;
        padding: 6rem 0;
    }

    .article-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .article-category {
        color: #0f3460;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 1rem;
    }

    .article-title {
        color: #1a1a2e;
        font-size: 3rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 2rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .article-meta {
        color: #666;
        font-size: 0.9rem;
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .article-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .article-text {
        color: #333;
        font-size: 1.1rem;
        line-height: 1.8;
        margin-bottom: 2rem;
        text-align: justify;
    }

    .article-text.crimson {
        font-size: 1.2rem;
        line-height: 1.9;
    }

    .article-text:first-of-type::first-letter {
        font-size: 4rem;
        font-weight: 700;
        float: left;
        line-height: 1;
        margin: 0 10px 0 0;
        color: #0f3460;
        font-family: 'Crimson Text', serif;
    }

    .quote-block {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-left: 5px solid #0f3460;
        padding: 3rem;
        margin: 3rem 0;
        border-radius: 0 15px 15px 0;
        position: relative;
    }

    .quote-block::before {
        content: '"';
        position: absolute;
        top: -1rem;
        left: 2rem;
        font-size: 6rem;
        color: #0f3460;
        opacity: 0.3;
        font-family: 'Crimson Text', serif;
        line-height: 1;
    }

    .quote-text {
        font-size: 1.4rem;
        font-style: italic;
        color: #1a1a2e;
        line-height: 1.6;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .quote-author {
        color: #0f3460;
        font-size: 1rem;
        font-weight: 600;
        text-align: right;
    }

    /* Enhanced Content Sections */
    .detailed-content-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 6rem 0;
    }

    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 3rem;
        margin-top: 4rem;
    }

    .content-card {
        background: #fff;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid #e9ecef;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .content-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(15, 52, 96, 0.05), transparent);
        transition: left 0.6s ease;
    }

    .content-card:hover::before {
        left: 100%;
    }

    .content-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .content-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #0f3460, #1a1a2e);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(15, 52, 96, 0.3);
    }

    .content-icon i {
        font-size: 1.8rem;
        color: #fff;
    }

    .content-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 1rem;
    }

    .content-text {
        font-size: 1rem;
        line-height: 1.7;
        color: #555;
    }

    .content-highlight {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #1a1a2e;
        padding: 0.2rem 0.5rem;
        border-radius: 5px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Biography Section */
    .biography-section {
        background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
        padding: 6rem 0;
        color: #fff;
    }

    .biography-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 4rem;
        align-items: center;
        margin-top: 4rem;
    }

    .biography-image {
        position: relative;
    }

    .biography-photo {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
    }

    .biography-photo:hover {
        transform: scale(1.05);
    }

    .biography-content {
        padding-left: 2rem;
    }

    .biography-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #ffd700;
        margin-bottom: 2rem;
    }

    .biography-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 2rem;
    }

    .biography-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .biography-detail {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 1.5rem;
    }

    .biography-detail-label {
        color: #ffd700;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .biography-detail-value {
        color: #fff;
        font-size: 1rem;
        font-weight: 500;
    }

    /* Vision Mission Grid */
    .vision-mission-section {
        background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
        padding: 6rem 0;
        color: #fff;
    }

    .vm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 3rem;
        margin-top: 4rem;
    }

    .vm-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 3rem;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .vm-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .vm-card:hover::before {
        left: 100%;
    }

    .vm-card:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.15);
    }

    .vm-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
    }

    .vm-icon i {
        font-size: 2rem;
        color: #1a1a2e;
    }

    .vm-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #ffd700;
    }

    .vm-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Statistics Section */
    .stats-section {
        background: #fff;
        padding: 6rem 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 3rem;
        margin-top: 4rem;
    }

    .stat-card {
        text-align: center;
        padding: 2rem;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        border: 1px solid #e9ecef;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 900;
        color: #0f3460;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-label {
        font-size: 1rem;
        color: #666;
        font-weight: 500;
    }

    /* Signature Section */
    .signature-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 6rem 0;
        text-align: center;
    }

    .signature-card {
        max-width: 600px;
        margin: 0 auto;
        background: #fff;
        border-radius: 20px;
        padding: 4rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid #e9ecef;
    }

    .signature-quote {
        font-size: 1.3rem;
        font-style: italic;
        color: #1a1a2e;
        margin-bottom: 3rem;
        line-height: 1.6;
    }

    .signature-line {
        width: 200px;
        height: 2px;
        background: linear-gradient(90deg, #0f3460, #1a1a2e);
        margin: 2rem auto;
    }

    .signature-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.5rem;
    }

    .signature-title {
        font-size: 1.1rem;
        color: #0f3460;
        font-weight: 500;
    }

    /* Scroll Animations */
    .fade-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    .fade-up.active {
        opacity: 1;
        transform: translateY(0);
    }

    .fade-in {
        opacity: 0;
        transition: opacity 0.8s ease;
    }

    .fade-in.active {
        opacity: 1;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero-title {
            font-size: 3.5rem;
        }

        .article-title {
            font-size: 2.5rem;
        }

        .content-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .biography-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        .biography-content {
            padding-left: 0;
        }
    }

    @media (max-width: 768px) {
        .magazine-header {
            min-height: 100vh;
        }

        .split-layout {
            grid-template-columns: 1fr;
            grid-template-rows: 50vh 50vh;
            height: 100vh;
        }

        .content-side {
            padding: 2rem 1.5rem;
            order: 2;
            justify-content: flex-start;
            padding-top: 3rem;
        }

        .image-side {
            order: 1;
        }

        .hero-title {
            font-size: 2.8rem;
            line-height: 1.1;
            margin-bottom: 1.5rem;
        }

        .hero-description {
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .rector-info-card {
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .rector-name {
            font-size: 1.5rem;
        }

        .rector-title {
            font-size: 0.9rem;
        }

        .rector-degree {
            font-size: 0.8rem;
        }

        .rector-detail-item {
            flex-direction: column;
            gap: 0.2rem;
            margin-bottom: 0.8rem;
        }

        .rector-detail-label {
            font-size: 0.8rem;
        }

        .rector-detail-value {
            font-size: 0.9rem;
        }

        .article-title {
            font-size: 2.2rem;
            line-height: 1.2;
        }

        .article-meta {
            flex-direction: column;
            gap: 0.5rem;
            align-items: center;
        }

        .magazine-title {
            position: absolute;
            top: 1rem;
            left: 1rem;
            font-size: 0.9rem;
            letter-spacing: 2px;
        }

        .magazine-date {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 0.8rem;
        }

        .vm-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .vm-card {
            padding: 2rem;
        }

        .vm-icon {
            width: 60px;
            height: 60px;
        }

        .vm-icon i {
            font-size: 1.5rem;
        }

        .vm-title {
            font-size: 1.5rem;
        }

        .vm-text {
            font-size: 1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .stat-card {
            padding: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
        }

        .article-content {
            padding: 0 1rem;
        }

        .article-text {
            font-size: 1rem;
            line-height: 1.7;
        }

        .quote-block {
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .quote-block::before {
            font-size: 4rem;
            top: -0.5rem;
            left: 1rem;
        }

        .quote-text {
            font-size: 1.2rem;
        }

        .biography-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .biography-content {
            padding-left: 0;
        }

        .biography-title {
            font-size: 2rem;
            text-align: center;
        }

        .biography-text {
            font-size: 1rem;
            text-align: justify;
        }

        .biography-details {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .biography-detail {
            padding: 1rem;
        }

        .content-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .content-card {
            padding: 2rem;
        }

        .content-icon {
            width: 60px;
            height: 60px;
        }

        .content-icon i {
            font-size: 1.5rem;
        }

        .content-title {
            font-size: 1.3rem;
        }

        .content-text {
            font-size: 0.95rem;
        }

        .signature-card {
            padding: 2.5rem 2rem;
        }

        .signature-quote {
            font-size: 1.1rem;
        }

        .signature-name {
            font-size: 1.5rem;
        }

        .signature-title {
            font-size: 1rem;
        }

        /* Section padding adjustments */
        .article-section,
        .detailed-content-section,
        .vision-mission-section,
        .stats-section,
        .signature-section,
        .biography-section {
            padding: 4rem 0;
        }

        .container {
            padding: 0 1rem;
        }
    }

    @media (max-width: 480px) {
        .split-layout {
            grid-template-rows: 45vh 55vh;
        }

        .content-side {
            padding: 1.5rem 1rem;
            padding-top: 2rem;
        }

        .hero-title {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        .hero-description {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .rector-info-card {
            padding: 1.2rem;
            margin-top: 1rem;
        }

        .rector-name {
            font-size: 1.3rem;
        }

        .rector-title {
            font-size: 0.85rem;
        }

        .rector-degree {
            font-size: 0.75rem;
        }

        .magazine-title {
            font-size: 0.8rem;
            letter-spacing: 1px;
        }

        .magazine-date {
            font-size: 0.7rem;
        }

        .article-title {
            font-size: 1.8rem;
            padding: 0 1rem;
        }

        .article-category {
            font-size: 0.8rem;
        }

        .article-meta {
            font-size: 0.8rem;
            gap: 0.3rem;
        }

        .article-text {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .article-text:first-of-type::first-letter {
            font-size: 3rem;
            margin: 0 8px 0 0;
        }

        .quote-block {
            padding: 1.2rem;
            margin: 1.5rem 0;
        }

        .quote-text {
            font-size: 1.1rem;
        }

        .quote-author {
            font-size: 0.9rem;
        }

        .vm-card {
            padding: 1.5rem;
        }

        .vm-icon {
            width: 50px;
            height: 50px;
        }

        .vm-icon i {
            font-size: 1.2rem;
        }

        .vm-title {
            font-size: 1.3rem;
        }

        .vm-text {
            font-size: 0.95rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .stat-card {
            padding: 1.2rem;
        }

        .stat-number {
            font-size: 2.2rem;
        }

        .stat-label {
            font-size: 0.85rem;
        }

        .biography-title {
            font-size: 1.8rem;
        }

        .biography-text {
            font-size: 0.95rem;
        }

        .biography-detail {
            padding: 0.8rem;
        }

        .biography-detail-label {
            font-size: 0.8rem;
        }

        .biography-detail-value {
            font-size: 0.9rem;
        }

        .content-card {
            padding: 1.5rem;
        }

        .content-icon {
            width: 50px;
            height: 50px;
        }

        .content-icon i {
            font-size: 1.2rem;
        }

        .content-title {
            font-size: 1.2rem;
        }

        .content-text {
            font-size: 0.9rem;
        }

        .signature-card {
            padding: 2rem 1.5rem;
        }

        .signature-quote {
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .signature-name {
            font-size: 1.3rem;
        }

        .signature-title {
            font-size: 0.95rem;
        }

        /* Section padding adjustments for mobile */
        .article-section,
        .detailed-content-section,
        .vision-mission-section,
        .stats-section,
        .signature-section,
        .biography-section {
            padding: 3rem 0;
        }

        .article-header {
            margin-bottom: 2rem;
        }

        .container {
            padding: 0 0.5rem;
        }
    }

    @media (max-width: 360px) {
        .hero-title {
            font-size: 1.9rem;
        }

        .article-title {
            font-size: 1.6rem;
        }

        .content-side {
            padding: 1rem;
        }

        .rector-info-card {
            padding: 1rem;
        }

        .quote-block {
            padding: 1rem;
        }

        .vm-card,
        .content-card {
            padding: 1.2rem;
        }

        .signature-card {
            padding: 1.5rem 1rem;
        }

        .biography-detail {
            padding: 0.6rem;
        }
    }

    /* Loading Animation */
    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #ffd700, #0f3460);
        z-index: 9999;
        transition: width 0.3s ease;
    }
</style>

<!-- Scroll Progress Indicator -->
<div class="scroll-indicator" id="scrollIndicator"></div>

<!-- Magazine Header -->
<section class="magazine-header">
    <div class="magazine-title">Universitas Mercu Buana</div>
    <div class="magazine-date">{{ date('F Y') }}</div>
    
    <div class="split-layout">
        <div class="content-side">
            <div class="hero-subtitle fade-up">Sambutan</div>
            <h1 class="hero-title fade-up">Rektor<br>Universitas</h1>
            <p class="hero-description fade-up">
                @if(isset($data) && count($data) > 0 && isset($data[0]->deskripsi_singkat) && !empty($data[0]->deskripsi_singkat))
                    {{ $data[0]->deskripsi_singkat }}
                @else
                    Selamat datang di era baru pendidikan tinggi yang mengutamakan inovasi, 
                    kualitas, dan pembentukan karakter. Mari bersama membangun masa depan 
                    yang gemilang melalui dedikasi dan komitmen yang berkelanjutan.
                @endif
            </p>
            
            @if(isset($data) && count($data) > 0)
                <div class="rector-info-card fade-up">
                    @if(isset($data[0]->nama))
                        <div class="rector-name">{{ $data[0]->nama }}</div>
                    @endif
                    @if(isset($data[0]->jabatan))
                        <div class="rector-title">{{ $data[0]->jabatan }}</div>
                    @endif
                    @if(isset($data[0]->gelar))
                        <div class="rector-degree">{{ $data[0]->gelar }}</div>
                    @endif
                    
                    <div class="rector-details">
                        @if(isset($data[0]->periode_mulai) || isset($data[0]->periode_selesai))
                            <div class="rector-detail-item">
                                <span class="rector-detail-label">Periode Jabatan:</span>
                                <span class="rector-detail-value">
                                    @if(isset($data[0]->periode_mulai))
                                        {{ $data[0]->periode_mulai }}
                                    @endif
                                    @if(isset($data[0]->periode_mulai) && isset($data[0]->periode_selesai))
                                        -
                                    @endif
                                    @if(isset($data[0]->periode_selesai))
                                        {{ $data[0]->periode_selesai }}
                                    @endif
                                </span>
                            </div>
                        @endif
                        @if(isset($data[0]->pendidikan))
                            <div class="rector-detail-item">
                                <span class="rector-detail-label">Pendidikan:</span>
                                <span class="rector-detail-value">{{ $data[0]->pendidikan }}</span>
                            </div>
                        @endif
                        @if(isset($data[0]->pengalaman))
                            <div class="rector-detail-item">
                                <span class="rector-detail-label">Pengalaman:</span>
                                <span class="rector-detail-value">{{ $data[0]->pengalaman }}</span>
                            </div>
                        @endif
                        @if(isset($data[0]->spesialisasi))
                            <div class="rector-detail-item">
                                <span class="rector-detail-label">Spesialisasi:</span>
                                <span class="rector-detail-value">{{ $data[0]->spesialisasi }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="rector-info-card fade-up">
                    <div class="rector-name">Prof. Dr. Rektor</div>
                    <div class="rector-title">Rektor Universitas Mercu Buana Yogyakarta</div>
                    <div class="rector-degree">Ph.D.</div>
                </div>
            @endif
        </div>
        
        <div class="image-side">
            <div class="image-overlay"></div>
            @if(isset($data) && count($data) > 0 && isset($data[0]->foto) && !empty($data[0]->foto))
                <img src="{{ asset('storage/' . $data[0]->foto) }}" 
                     alt="Foto {{ $data[0]->nama ?? 'Rektor' }}" 
                     class="hero-image"
                     loading="lazy"
                     onerror="this.src='https://via.placeholder.com/800x1000/1a1a2e/ffffff?text=Foto+Rektor'">
            @else
                <img src="https://via.placeholder.com/800x1000/1a1a2e/ffffff?text=Foto+Rektor" 
                     alt="Foto Rektor" 
                     class="hero-image loading-shimmer">
            @endif
        </div>
    </div>
</section>

<!-- Article Section -->
<section class="article-section">
    <div class="container">
        @if(isset($data) && count($data) > 0)
            @foreach($data as $index => $sambutan)
                <div class="article-header fade-up">
                    <div class="article-category">
                        @if(isset($sambutan->kategori) && !empty($sambutan->kategori))
                            {{ $sambutan->kategori }}
                        @else
                            Pesan Kepemimpinan
                        @endif
                    </div>
                    <h2 class="article-title">
                        @if(isset($sambutan->judul) && !empty($sambutan->judul))
                            {{ $sambutan->judul }}
                        @else
                            Membangun Masa Depan Pendidikan Berkualitas
                        @endif
                    </h2>
                    <div class="article-meta">
                        <span><i class="fas fa-calendar-alt"></i> 
                            @if(isset($sambutan->tanggal) && !empty($sambutan->tanggal))
                                {{ date('d F Y', strtotime($sambutan->tanggal)) }}
                            @else
                                {{ date('d F Y') }}
                            @endif
                        </span>
                        <span><i class="fas fa-clock"></i> 
                            @if(isset($sambutan->estimasi_baca) && !empty($sambutan->estimasi_baca))
                                {{ $sambutan->estimasi_baca }} min read
                            @else
                                5 min read
                            @endif
                        </span>
                        <span><i class="fas fa-user"></i> 
                            @if(isset($sambutan->penulis) && !empty($sambutan->penulis))
                                {{ $sambutan->penulis }}
                            @else
                                Rektor
                            @endif
                        </span>
                    </div>
                </div>

                <div class="article-content">
                    @if(isset($sambutan->salam) && !empty($sambutan->salam))
                        <div class="quote-block fade-up">
                            <div class="quote-text crimson">{{ $sambutan->salam }}</div>
                            <div class="quote-author">
                                @if(isset($sambutan->salam_kategori) && !empty($sambutan->salam_kategori))
                                    — {{ $sambutan->salam_kategori }}
                                @else
                                    — Sambutan Pembuka
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(isset($sambutan->deskripsi) && !empty($sambutan->deskripsi))
                        <div class="article-text crimson fade-up">
                            {!! $sambutan->deskripsi !!}
                        </div>
                    @endif

                    @if(isset($sambutan->pesan_khusus) && !empty($sambutan->pesan_khusus))
                        <div class="quote-block fade-up">
                            <div class="quote-text crimson">{{ $sambutan->pesan_khusus }}</div>
                            <div class="quote-author">
                                @if(isset($sambutan->pesan_kategori) && !empty($sambutan->pesan_kategori))
                                    — {{ $sambutan->pesan_kategori }}
                                @else
                                    — Pesan Khusus
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(isset($sambutan->kesimpulan) && !empty($sambutan->kesimpulan))
                        <div class="article-text crimson fade-up">
                            {!! $sambutan->kesimpulan !!}
                        </div>
                    @endif
                </div>

                @if(!$loop->last)
                    <hr style="margin: 4rem 0; border: none; height: 1px; background: linear-gradient(90deg, transparent, #e9ecef, transparent);">
                @endif
            @endforeach
        @else
            <div class="article-header fade-up">
                <div class="article-category">Pesan Kepemimpinan</div>
                <h2 class="article-title">Membangun Masa Depan Pendidikan Berkualitas</h2>
                <div class="article-meta">
                    <span><i class="fas fa-calendar-alt"></i> {{ date('d F Y') }}</span>
                    <span><i class="fas fa-clock"></i> 5 min read</span>
                    <span><i class="fas fa-user"></i> Rektor</span>
                </div>
            </div>

            <div class="article-content">
                <div class="quote-block fade-up">
                    <div class="quote-text crimson">Selamat datang di komunitas akademik yang berkomitmen pada keunggulan dan inovasi dalam pendidikan tinggi.</div>
                    <div class="quote-author">— Sambutan Pembuka</div>
                </div>

                <div class="article-text crimson fade-up">
                    <p>Sebagai pemimpin institusi pendidikan tinggi yang berkomitmen pada keunggulan, saya dengan bangga menyambut Anda di Universitas Mercu Buana Yogyakarta. Kami adalah komunitas akademik yang berdedikasi untuk menghasilkan lulusan berkualitas tinggi dan berdaya saing global.</p>
                    
                    <p>Dalam era transformasi digital dan globalisasi ini, kami terus berinovasi dalam memberikan pendidikan terbaik, mengembangkan riset yang bermanfaat bagi masyarakat, dan membangun karakter mahasiswa yang berintegritas. Setiap langkah yang kami ambil diarahkan untuk menciptakan lingkungan akademik yang kondusif bagi pertumbuhan intelektual dan pengembangan potensi diri.</p>
                    
                    <p>Mari bersama-sama membangun masa depan yang gemilang melalui dedikasi, inovasi, dan kolaborasi yang berkelanjutan. Dengan semangat keunggulan dan komitmen terhadap kualitas, kita akan mewujudkan visi universitas sebagai institusi pendidikan terdepan yang berkontribusi positif bagi kemajuan bangsa.</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Biography Section -->
@if(isset($data) && count($data) > 0 && (isset($data[0]->biografi) || isset($data[0]->riwayat_karir) || isset($data[0]->prestasi)))
<section class="biography-section">
    <div class="container">
        <div class="article-header fade-up">
            <div class="article-category" style="color: #ffd700;">Profil Lengkap</div>
            <h2 class="article-title" style="color: #fff;">
                @if(isset($data[0]->nama))
                    Biografi {{ $data[0]->nama }}
                @else
                    Biografi Rektor
                @endif
            </h2>
        </div>
        
        <div class="biography-grid">
            <div class="biography-image fade-up">
                @if(isset($data[0]->foto_formal) && !empty($data[0]->foto_formal))
                    <img src="{{ asset('storage/' . $data[0]->foto_formal) }}" 
                         alt="Foto Formal {{ $data[0]->nama ?? 'Rektor' }}" 
                         class="biography-photo"
                         onerror="this.src='{{ isset($data[0]->foto) ? asset('storage/' . $data[0]->foto) : 'https://via.placeholder.com/400x500/1a1a2e/ffffff?text=Foto+Rektor' }}'">
                @elseif(isset($data[0]->foto) && !empty($data[0]->foto))
                    <img src="{{ asset('storage/' . $data[0]->foto) }}" 
                         alt="Foto {{ $data[0]->nama ?? 'Rektor' }}" 
                         class="biography-photo">
                @else
                    <img src="https://via.placeholder.com/400x500/1a1a2e/ffffff?text=Foto+Rektor" 
                         alt="Foto Rektor" 
                         class="biography-photo">
                @endif
            </div>
            
            <div class="biography-content fade-up">
                <h3 class="biography-title">
                    @if(isset($data[0]->nama))
                        {{ $data[0]->nama }}
                    @else
                        Rektor Universitas
                    @endif
                </h3>
                
                @if(isset($data[0]->biografi) && !empty($data[0]->biografi))
                    <div class="biography-text">
                        {!! $data[0]->biografi !!}
                    </div>
                @endif
                
                @if(isset($data[0]->riwayat_karir) && !empty($data[0]->riwayat_karir))
                    <div class="biography-text">
                        <strong>Riwayat Karir:</strong><br>
                        {!! $data[0]->riwayat_karir !!}
                    </div>
                @endif
                
                @if(isset($data[0]->prestasi) && !empty($data[0]->prestasi))
                    <div class="biography-text">
                        <strong>Prestasi dan Penghargaan:</strong><br>
                        {!! $data[0]->prestasi !!}
                    </div>
                @endif
                
                <div class="biography-details">
                    @if(isset($data[0]->tempat_lahir) || isset($data[0]->tanggal_lahir))
                        <div class="biography-detail fade-up">
                            <div class="biography-detail-label">Tempat, Tanggal Lahir</div>
                            <div class="biography-detail-value">
                                @if(isset($data[0]->tempat_lahir))
                                    {{ $data[0]->tempat_lahir }}
                                @endif
                                @if(isset($data[0]->tempat_lahir) && isset($data[0]->tanggal_lahir))
                                    ,
                                @endif
                                @if(isset($data[0]->tanggal_lahir))
                                    {{ date('d F Y', strtotime($data[0]->tanggal_lahir)) }}
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    @if(isset($data[0]->almamater))
                        <div class="biography-detail fade-up">
                            <div class="biography-detail-label">Almamater</div>
                            <div class="biography-detail-value">{{ $data[0]->almamater }}</div>
                        </div>
                    @endif
                    
                    @if(isset($data[0]->bidang_keahlian))
                        <div class="biography-detail fade-up">
                            <div class="biography-detail-label">Bidang Keahlian</div>
                            <div class="biography-detail-value">{{ $data[0]->bidang_keahlian }}</div>
                        </div>
                    @endif
                    
                    @if(isset($data[0]->publikasi_count))
                        <div class="biography-detail fade-up">
                            <div class="biography-detail-label">Publikasi</div>
                            <div class="biography-detail-value">{{ $data[0]->publikasi_count }} Karya</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif








<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll Progress Indicator
    function updateScrollProgress() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        document.getElementById('scrollIndicator').style.width = scrollPercent + '%';
    }

    window.addEventListener('scroll', updateScrollProgress);

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                
                // Animate counters
                if (entry.target.querySelector('[data-count]')) {
                    const counters = entry.target.querySelectorAll('[data-count]');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-count'));
                        const duration = 2000;
                        const step = target / (duration / 16);
                        let current = 0;
                        
                        const timer = setInterval(() => {
                            current += step;
                            if (current >= target) {
                                current = target;
                                clearInterval(timer);
                            }
                            counter.textContent = Math.floor(current);
                        }, 16);
                    });
                }
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.fade-up, .fade-in').forEach(el => {
        observer.observe(el);
    });

    // Parallax effect for hero image
    if (window.innerWidth > 768) {
        window.addEventListener('scroll', parallaxHandler);
    }

    // Image loading with fade effect
    const images = document.querySelectorAll('.hero-image, .biography-photo');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.classList.remove('loading-shimmer');
            this.style.opacity = '1';
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add hover effects to cards
    const cards = document.querySelectorAll('.vm-card, .stat-card, .content-card, .biography-detail');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Magazine-style text effects
    const articleTexts = document.querySelectorAll('.article-text p');
    articleTexts.forEach((text, index) => {
        if (index > 0) { // Skip first paragraph (already has drop cap)
            text.style.animationDelay = `${index * 0.2}s`;
        }
    });

    // Dynamic background for header based on scroll
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const header = document.querySelector('.magazine-header');
        if (header) {
            const opacity = Math.max(0, 1 - scrolled / window.innerHeight);
            header.style.opacity = opacity;
        }
    });

    // Enhanced card interactions
    const contentCards = document.querySelectorAll('.content-card');
    contentCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.content-icon');
            if (icon) {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
                icon.style.transition = 'transform 0.3s ease';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.content-icon');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });

        // Touch interactions for mobile
        card.addEventListener('touchstart', function() {
            const icon = this.querySelector('.content-icon');
            if (icon) {
                icon.style.transform = 'scale(1.05) rotate(3deg)';
            }
        });

        card.addEventListener('touchend', function() {
            const icon = this.querySelector('.content-icon');
            if (icon) {
                setTimeout(() => {
                    icon.style.transform = 'scale(1) rotate(0deg)';
                }, 150);
            }
        });
    });

    // Staggered animation for content grid
    const contentGridItems = document.querySelectorAll('.content-grid .content-card');
    contentGridItems.forEach((item, index) => {
        item.style.animationDelay = `${index * 0.1}s`;
    });

    // Mobile-specific optimizations
    function handleMobileOptimizations() {
        const isMobile = window.innerWidth <= 768;
        
        if (isMobile) {
            // Disable parallax on mobile for better performance
            window.removeEventListener('scroll', parallaxHandler);
            
            // Optimize scroll animations for mobile
            const mobileObserverOptions = {
                threshold: 0.05,
                rootMargin: '0px 0px -20px 0px'
            };
            
            const mobileObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, mobileObserverOptions);

            // Re-observe elements with mobile-optimized settings
            document.querySelectorAll('.fade-up, .fade-in').forEach(el => {
                mobileObserver.observe(el);
            });
        }
    }

    // Parallax handler function
    function parallaxHandler() {
        const scrolled = window.pageYOffset;
        const heroImage = document.querySelector('.hero-image');
        if (heroImage) {
            const speed = 0.5;
            heroImage.style.transform = `translateY(${scrolled * speed}px) scale(1.1)`;
        }
    }

    // Initial mobile optimization check
    handleMobileOptimizations();

    // Re-check on resize
    window.addEventListener('resize', function() {
        handleMobileOptimizations();
    });

    // Touch-friendly hover effects for mobile
    if ('ontouchstart' in window) {
        const touchCards = document.querySelectorAll('.vm-card, .stat-card, .content-card, .biography-detail');
        touchCards.forEach(card => {
            card.addEventListener('touchstart', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
                this.style.transition = 'transform 0.2s ease';
            });
            
            card.addEventListener('touchend', function() {
                setTimeout(() => {
                    this.style.transform = 'translateY(0) scale(1)';
                }, 100);
            });
        });
    }
});
</script>

@endsection
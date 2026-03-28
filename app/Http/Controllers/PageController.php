<?php

namespace App\Http\Controllers;

use App\Mail\PaymentNotificationMail;
use App\Models\SiteSettings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PageController extends Controller
{
    /** @return array<int, array<string, string>> */
    private function blogPosts(): array
    {
        return [
            [
                'slug' => 'nis2-directive-what-organisations-need-to-know',
                'title' => 'NIS2 Directive: What EU Organisations Need to Know Before the Deadline',
                'category' => 'Compliance',
                'date' => 'March 12, 2026',
                'author' => 'GISBA Editorial Team',
                'read_time' => '6 min read',
                'excerpt' => 'The NIS2 Directive represents the most significant overhaul of EU cybersecurity legislation in a decade. Here\'s what your organisation must do to achieve compliance — and avoid penalties of up to €10 million.',
                'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=800&h=450&fit=crop&auto=format',
                'content' => '
                    <p class="blog-lead">The EU\'s Network and Information Security Directive 2 (NIS2) entered into force in January 2023, with Member States required to transpose it into national law by October 2024. For organisations operating in critical sectors, the compliance clock is ticking — and the stakes have never been higher.</p>

                    <h2>What Is NIS2 and Why Does It Matter?</h2>
                    <p>NIS2 supersedes the original NIS Directive of 2016, dramatically expanding its scope and enforcement powers. Where the original directive applied to a limited set of operators of essential services, NIS2 now covers <strong>18 critical sectors</strong> — from energy and transport to healthcare, digital infrastructure, and manufacturing.</p>
                    <p>Perhaps most significantly, NIS2 introduces meaningful penalties for non-compliance: up to <strong>€10 million or 2% of global annual turnover</strong> for essential entities, whichever is higher. For important entities, penalties reach €7 million or 1.4% of turnover. These figures align NIS2 with GDPR in terms of regulatory severity.</p>

                    <div class="blog-callout">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>
                            <strong>Key Deadline:</strong> Member States were required to transpose NIS2 into national law by 17 October 2024. Organisations in scope must be compliant — or face escalating enforcement action.
                        </div>
                    </div>

                    <h2>Who Is in Scope?</h2>
                    <p>NIS2 distinguishes between two tiers of entities:</p>
                    <ul class="blog-list">
                        <li><strong>Essential Entities</strong> — Large organisations in high-criticality sectors: energy, transport, banking, financial market infrastructure, health, drinking water, wastewater, digital infrastructure, ICT service management, public administration, and space.</li>
                        <li><strong>Important Entities</strong> — Medium and large organisations in other critical sectors: postal services, waste management, chemicals, food, manufacturing, digital providers, and research.</li>
                    </ul>
                    <p>The size-cap rule generally applies: organisations with 250+ employees, or those with an annual turnover exceeding €50 million and a balance sheet total exceeding €43 million, fall within scope. However, some sectors apply regardless of size.</p>

                    <h2>Key Cybersecurity Obligations</h2>
                    <p>NIS2 mandates a risk-based approach to cybersecurity, requiring in-scope organisations to implement a minimum set of security measures, including:</p>
                    <ul class="blog-list">
                        <li>Policies on risk analysis and information system security</li>
                        <li>Incident handling and business continuity procedures</li>
                        <li>Supply chain security measures</li>
                        <li>Secure acquisition, development, and maintenance of network systems</li>
                        <li>Policies and procedures for assessing the effectiveness of cybersecurity measures</li>
                        <li>Basic cyber hygiene practices and cybersecurity training</li>
                        <li>Policies and procedures on the use of cryptography and encryption</li>
                        <li>Human resources security and access control policies</li>
                        <li>Multi-factor authentication and continuous authentication solutions</li>
                    </ul>

                    <h2>Management Accountability: A New Frontier</h2>
                    <p>One of the most consequential aspects of NIS2 is its direct imposition of accountability on management bodies. Board members and senior executives can now be held <strong>personally liable</strong> for failing to ensure compliance with NIS2 obligations. Competent authorities can temporarily prohibit individuals from holding managerial positions at essential entities in cases of repeated or severe violations.</p>

                    <div class="blog-callout blog-callout--gold">
                        <i class="bi bi-lightbulb-fill"></i>
                        <div>
                            <strong>GISBA Insight:</strong> NIS2 is fundamentally a governance challenge, not just a technical one. Boards that treat cybersecurity as an IT problem rather than a business risk will be most exposed to regulatory scrutiny.
                        </div>
                    </div>

                    <h2>Incident Reporting Requirements</h2>
                    <p>NIS2 establishes a <strong>three-stage reporting timeline</strong> for significant incidents:</p>
                    <ul class="blog-list">
                        <li><strong>24 hours</strong> — Early warning to the national CSIRT or competent authority</li>
                        <li><strong>72 hours</strong> — Incident notification with initial assessment of severity and impact</li>
                        <li><strong>1 month</strong> — Final report with full analysis, root cause, and mitigation measures applied</li>
                    </ul>

                    <h2>How GISBA Can Help</h2>
                    <p>GISBA\'s NIS2 Implementation Toolkit is designed to take organisations from initial gap assessment through to full certification readiness. Our consultants have deep expertise in EU cybersecurity regulation and have supported organisations across the UK, EU, and the Middle East in achieving compliance with major information security frameworks since 2006.</p>
                    <p>Whether you\'re starting your NIS2 journey or accelerating an existing compliance programme, we offer the tools, training, and expert guidance you need.</p>
                ',
            ],
            [
                'slug' => 'building-a-cyber-resilient-organisation',
                'title' => 'Building a Cyber-Resilient Organisation: Frameworks, Strategy, and Best Practices',
                'category' => 'Cybersecurity',
                'date' => 'February 28, 2026',
                'author' => 'GISBA Editorial Team',
                'read_time' => '8 min read',
                'excerpt' => 'Cyber resilience goes far beyond perimeter defence. Discover the frameworks, methodologies, and organisational practices that distinguish truly resilient organisations from those simply hoping for the best.',
                'image' => 'https://images.unsplash.com/photo-1563986768494-4dee2763ff3f?w=800&h=450&fit=crop&auto=format',
                'content' => '
                    <p class="blog-lead">In an era where breaches are a question of when, not if, the goal of cybersecurity has fundamentally shifted. The organisations that emerge strongest from cyber incidents are not those that never get attacked — they are those built to absorb, adapt, and recover when attacks succeed.</p>

                    <h2>Resilience vs. Security: Understanding the Distinction</h2>
                    <p>Traditional cybersecurity thinking is primarily defensive: build walls, block threats, prevent intrusions. Cyber resilience acknowledges a harder truth — that no defence is impenetrable. Resilience is about <strong>organisational capacity</strong>: the ability to continue operating through disruption and recover rapidly when disruption occurs.</p>
                    <p>The most resilient organisations blend robust preventive controls with equally robust detection, response, and recovery capabilities. The NIST Cybersecurity Framework captures this well with its five core functions: Identify, Protect, Detect, Respond, and Recover.</p>

                    <div class="blog-callout">
                        <i class="bi bi-shield-check-fill"></i>
                        <div>
                            <strong>The Resilience Mindset:</strong> Design your organisation not just to resist attacks, but to absorb and recover from them. This shift in thinking changes everything — from architecture to governance to culture.
                        </div>
                    </div>

                    <h2>Key Frameworks for Cyber Resilience</h2>

                    <h3>1. ISO/IEC 27001: Information Security Management</h3>
                    <p>ISO 27001 remains the gold standard for information security management. It provides a systematic approach to managing sensitive company information, covering people, processes, and technology. Critically, it is <strong>risk-based</strong> — requiring organisations to identify their specific threats and vulnerabilities and implement proportionate controls.</p>

                    <h3>2. ISO 22301: Business Continuity Management</h3>
                    <p>Business continuity planning is the operational backbone of cyber resilience. ISO 22301 provides a framework for identifying potential threats, assessing their impact on operations, and building robust recovery capabilities. Organisations certified to ISO 22301 demonstrate to regulators, customers, and partners that they have credible plans for maintaining operations during and after incidents.</p>

                    <h3>3. NIST Cybersecurity Framework (CSF 2.0)</h3>
                    <p>The updated NIST CSF 2.0 adds a critical new function — <strong>Govern</strong> — to its existing five-function structure. This acknowledges that cybersecurity risk management must be embedded in organisational governance, not siloed in IT departments.</p>

                    <h2>The Human Dimension: Culture and Training</h2>
                    <p>Technology controls can only go so far. The overwhelming majority of successful cyber attacks exploit human vulnerabilities: phishing emails, social engineering, weak passwords, misconfigured systems. Building resilience therefore requires sustained investment in:</p>
                    <ul class="blog-list">
                        <li><strong>Awareness training</strong> that evolves with the threat landscape</li>
                        <li><strong>Phishing simulation exercises</strong> to build practical recognition skills</li>
                        <li><strong>Security-conscious culture</strong> where reporting incidents is encouraged, not penalised</li>
                        <li><strong>Leadership commitment</strong> — security behaviours cascade from the top down</li>
                    </ul>

                    <div class="blog-callout blog-callout--gold">
                        <i class="bi bi-people-fill"></i>
                        <div>
                            <strong>GISBA Insight:</strong> The organisations we have seen achieve the highest resilience maturity are those where security is treated as everyone\'s responsibility — not just the CISO\'s. Cultural transformation is the hardest and most rewarding part of the journey.
                        </div>
                    </div>

                    <h2>Supply Chain: The Expanding Attack Surface</h2>
                    <p>High-profile attacks on supply chains — from SolarWinds to MOVEit — have demonstrated that an organisation\'s resilience is only as strong as its weakest third-party link. Effective supply chain security requires:</p>
                    <ul class="blog-list">
                        <li>Rigorous third-party risk assessment before onboarding suppliers</li>
                        <li>Contractual security requirements and audit rights</li>
                        <li>Continuous monitoring of critical supplier relationships</li>
                        <li>Incident response planning that accounts for third-party compromise scenarios</li>
                    </ul>
                    <p>NIS2 explicitly addresses supply chain security, requiring in-scope organisations to manage and document the cybersecurity risks posed by their suppliers and service providers.</p>

                    <h2>Building Your Resilience Roadmap</h2>
                    <p>There is no single path to cyber resilience, but there is a logical sequence that most organisations follow:</p>
                    <ul class="blog-list">
                        <li><strong>Assess:</strong> Understand your current posture — assets, threats, vulnerabilities, existing controls</li>
                        <li><strong>Prioritise:</strong> Risk-rank your gaps and focus first on critical business functions</li>
                        <li><strong>Implement:</strong> Deploy controls aligned to recognised frameworks (ISO 27001, NIST CSF)</li>
                        <li><strong>Test:</strong> Regular exercises — tabletop, red team, penetration testing — validate your defences</li>
                        <li><strong>Improve:</strong> Treat every incident and near-miss as a learning opportunity</li>
                    </ul>

                    <h2>How GISBA Supports Your Resilience Journey</h2>
                    <p>With nearly 20 years of experience supporting organisations across the UK, EU, GCC, and beyond, GISBA brings deep practical expertise to every stage of the resilience journey. From initial assessments and gap analysis through to ISO certification, board-level awareness training, and ongoing consultancy — our team delivers outcomes that endure.</p>
                ',
            ],
        ];
    }

    public function home(): View
    {
        return view('pages.home');
    }

    public function nis2(): View
    {
        $pricing = SiteSettings::current();

        return view('pages.nis2-implementation-toolkit', compact('pricing'));
    }

    public function nis2Pricing(): View
    {
        $pricing = SiteSettings::current();

        return view('pages.nis2-pricing', compact('pricing'));
    }

    public function training(): View
    {
        return view('pages.training-course-development');
    }

    public function successStories(): View
    {
        return view('pages.success-stories');
    }

    public function successStoriesEu(): View
    {
        return view('pages.success-stories-eu');
    }

    public function successStoriesMe(): View
    {
        return view('pages.success-stories-me');
    }

    public function contactUs(): View
    {
        return view('pages.contact-us');
    }

    public function privacyPolicy(): View
    {
        return view('pages.privacy-policy');
    }

    public function digitalDeliveryPolicy(): View
    {
        return view('pages.digital-delivery-policy');
    }

    public function digitalRefundPolicy(): View
    {
        return view('pages.digital-refund-policy');
    }

    public function termsOfUse(): View
    {
        return view('pages.terms-of-use');
    }

    public function paymentSuccess(): View
    {
        try {
            Mail::to(config('mail.enquiry_recipient', 'support@gisba.net'))
                ->send(new PaymentNotificationMail);
        } catch (\Throwable $e) {
            Log::error('PaymentNotificationMail failed', ['error' => $e->getMessage()]);
        }

        return view('pages.payment-success');
    }

    public function blog(): View
    {
        return view('pages.blog', ['posts' => $this->blogPosts()]);
    }

    public function blogShow(string $slug): View|RedirectResponse
    {
        $posts = $this->blogPosts();
        $post = collect($posts)->firstWhere('slug', $slug);

        if (! $post) {
            abort(404);
        }

        return view('pages.blog-show', ['post' => $post, 'posts' => $posts]);
    }
}

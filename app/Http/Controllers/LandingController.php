<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Example tools data - you can move this to database later
        $tools = [
            [
                'name' => 'Project Manager Pro',
                'description' => 'Comprehensive project management solution with team collaboration',
                'icon' => 'mdi-clipboard-text',
                'features' => ['Task Management', 'Team Collaboration', 'Timeline View', 'Reports'],
                'color' => 'primary'
            ],
            [
                'name' => 'CRM System',
                'description' => 'Customer relationship management with sales pipeline tracking',
                'icon' => 'mdi-account-group',
                'features' => ['Contact Management', 'Sales Pipeline', 'Email Integration', 'Analytics'],
                'color' => 'success'
            ],
            [
                'name' => 'Email Marketing',
                'description' => 'Advanced email marketing platform with automation',
                'icon' => 'mdi-email-newsletter',
                'features' => ['Campaign Builder', 'Automation', 'A/B Testing', 'Analytics'],
                'color' => 'info'
            ],
            [
                'name' => 'Analytics Dashboard',
                'description' => 'Real-time analytics and reporting for all your tools',
                'icon' => 'mdi-chart-line',
                'features' => ['Real-time Data', 'Custom Reports', 'Data Export', 'Visualizations'],
                'color' => 'warning'
            ],
            [
                'name' => 'File Storage',
                'description' => 'Secure cloud storage with team sharing capabilities',
                'icon' => 'mdi-folder-multiple',
                'features' => ['Unlimited Storage', 'File Sharing', 'Version Control', 'Security'],
                'color' => 'danger'
            ],
            [
                'name' => 'Time Tracker',
                'description' => 'Track time, manage productivity, and generate invoices',
                'icon' => 'mdi-clock-outline',
                'features' => ['Time Tracking', 'Invoicing', 'Reports', 'Team Management'],
                'color' => 'secondary'
            ]
        ];

        // Pricing plans
        $plans = [
            [
                'name' => 'Starter',
                'price' => 29,
                'period' => 'month',
                'description' => 'Perfect for individuals and small teams',
                'features' => [
                    'Access to 2 tools of your choice',
                    'Up to 5 team members',
                    'Basic support',
                    '10 GB storage',
                    'Email support'
                ],
                'highlighted' => false,
                'color' => 'primary'
            ],
            [
                'name' => 'Professional',
                'price' => 79,
                'period' => 'month',
                'description' => 'Best for growing businesses',
                'features' => [
                    'Access to 4 tools of your choice',
                    'Up to 20 team members',
                    'Priority support',
                    '100 GB storage',
                    '24/7 chat support',
                    'Advanced analytics'
                ],
                'highlighted' => true,
                'color' => 'success'
            ],
            [
                'name' => 'Enterprise',
                'price' => 199,
                'period' => 'month',
                'description' => 'For large organizations',
                'features' => [
                    'Access to ALL tools',
                    'Unlimited team members',
                    'Dedicated support',
                    'Unlimited storage',
                    'Phone & chat support',
                    'Custom integrations',
                    'SLA guarantee'
                ],
                'highlighted' => false,
                'color' => 'info'
            ]
        ];

        return view('landing', compact('tools', 'plans'));
    }
}


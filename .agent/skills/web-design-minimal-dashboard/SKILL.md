---
name: web-design-minimal-dashboard
description: Guidelines and components for designing minimalist, data-driven dashboards with dark mode defaults.
---

# Minimalist Dashboard Design Skill

This skill provides a comprehensive framework for designing and implementing modern, clean, and data-driven dashboards. It prioritizes clarity, readability, and a premium "Minimalist" aesthetic.

## Design Philosophy
- **Minimalism**: Remove unnecessary elements. Focus on the data.
- **Hierarchy**: Use whitespace and font weights to establish a clear information hierarchy.
- **Meaningful Color**: Colors should indicate status (Success, Warning, Danger) rather than just being decorative.
- **Dark Mode by Default**: Optimized for low-light environments with high-contrast data presentation.

## Color Palette (Dark Mode)
| Element | Hex Code | Purpose |
| :--- | :--- | :--- |
| **Background** | `#0f172a` (Slate 900) | Main app background |
| **Surface** | `#1e293b` (Slate 800) | Cards, sidebars, bars |
| **Primary** | `#38bdf8` (Sky 400) | Links, buttons, primary data |
| **Success** | `#10b981` (Emerald 500) | Positive values, "Up" status |
| **Danger** | `#ef4444` (Red 500) | Negative values, "Down" status |
| **Text (Primary)** | `#f8fafc` (Slate 50) | Main headings and labels |
| **Text (Secondary)** | `#94a3b8` (Slate 400) | Subtle text, units, descriptions |

## Layout Structure
1. **Top Bar**: Global status summary (e.g., "All Systems Operational").
2. **Stat Cards**: Quick metrics showing absolute values and percentage changes.
3. **Charts Section**: Visual representation of trends (Uptime, Response Time).
4. **Interactive Filters**: Simple toggles/dropdowns for time range or view modes.

## Component Implementation

### 1. Stat Card Template (Alpine.js)
```html
<div class="p-6 bg-slate-800 rounded-xl border border-slate-700">
    <div class="text-sm font-medium text-slate-400">Response Time</div>
    <div class="mt-2 flex items-baseline gap-2">
        <span class="text-2xl font-bold text-white">45ms</span>
        <span class="text-xs font-semibold text-emerald-500">↓ 12%</span>
    </div>
</div>
```

### 2. Chart.js Configuration
Use a minimalist configuration for Chart.js to match the aesthetic:
- Remove grid lines (or make them very subtle).
- Use smooth curves (monotone).
- Gradient fills under line charts.

```javascript
const chartConfig = {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: 'Response Time',
            data: values,
            borderColor: '#38bdf8',
            backgroundColor: 'rgba(56, 189, 248, 0.1)',
            fill: true,
            tension: 0.4,
            borderWidth: 2,
            pointRadius: 0
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false }, ticks: { color: '#94a3b8' } },
            y: { grid: { color: '#334155' }, ticks: { color: '#94a3b8' } }
        }
    }
};
```

## Recommended Tools
- **CSS**: Vanilla CSS or Tailwind CSS for utility-first styling.
- **Interactivity**: Alpine.js for lightweight state management (filters, tabs).
- **Visualization**: Chart.js for data-driven graphics.
- **Typography**: Inter or Roboto for readability.
